<?php

namespace App\Http\Controllers;

use Auth;
use App\Bookmark;
use App\RemotePage;
use App\PageContentParser;
use App\Tag;
use App\BookmarkTag;
use Validator;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class BookmarksController extends BaseController {

    protected $redirectPath = "/dashboard";
    protected $bookmarkEditPath = "/bookmark/edit/";
    protected $bookmarksPath = "/bookmark";

    public function index() {
        $bookmarks = Bookmark::all();
        
        //Now get the tags for each bookmark
        //First get the tag id from bookmarks_tag
        //Then the name from tags
        foreach($bookmarks as &$bookmark) {
            //tagIDs is an array of BookmarkTag
            $tagIDs = BookmarkTag::where('bookmark_id', $bookmark->bookmark_id)->get();
            
            $tagNames = [];
            
            //Find each tag name from the tag_id and append it to $tagNames
            foreach($tagIDs as $tag) {
                $tagName = Tag::where('tag_id', $tag->tag_id)->get();
                $tagNames[] = $tagName[0]->tag_name;
            }
            
            //Convert to comma seperated list (for jquery.tagsinput.min.js)
            $tagNames = implode(",", $tagNames);
            
            //Now add the list to the bookmark object
            $bookmark->tags = $tagNames;
        }
        
        $data = array(
            'bookmarks' => $bookmarks,
        );
        
        return view('bookmark/view-bookmark')->with($data);
        return $bookmarks;
    }
    
    public function find($id) {
        try {
            $bookmark = Bookmark::findOrFail($id);
            $data = [
                'bookmark' => $bookmark  
            ];
            return view('bookmark/view-bookmark')->with($data);
        } catch (ModelNotFoundException $e) {
            return "Bookmark not found: " . $e->getMessage();
        }
    }
    
    /**
     * Edit a bookmark
     * @param  Integer $id The bookmark_id of the bookmark
     * @return View    A view for editing the bookmark
     */
    public function getEdit($id) {
        $userID = Auth::user()->id;
        
        try {
            //Find the bookmark with ID=$id
            $bookmark = Bookmark::findOrFail($id);
            
            //Now find it's tags
            $tagsForBookmark = BookmarkTag::where('bookmark_id', $bookmark->bookmark_id)->get();
            
            if(sizeof($tagsForBookmark) > 0) {
                $tagNames = [];
                
                foreach($tagsForBookmark as $tagItem) {  
                    $tagName = Tag::where('tag_id', $tagItem->tag_id)->get()[0]->tag_name;
                    $tagNames[] = $tagName;
                }
                $tags = $tagNames;
            }
            else {
                //Create a new PageContentParser with the bookmark's content
                $contentParser = new PageContentParser($bookmark->content);
                //Get 5 suggested tags
                $tags = $contentParser->getTags(5);
            }
            $data = [
                'bookmark' => $bookmark,
                'userID' => $userID,
                'tags' => implode(",", $tags)
            ];
            return view('bookmark/edit-bookmark')->with($data);
        } catch (ModelNotFoundException $e) {
            return "Bookmark not found: " . $e->getMessage();
        }
    }
    
    public function postEdit(Request $request) {
        $userID = Auth::user()->id;
        
        //Make sure title and tags are provided
        $validator = $this->editValidator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }
        
        $tags = explode(",", $request->tags);
        
        try {
            //Find the bookmark with ID=$id
            $bookmark = Bookmark::findOrFail($request->id);
            
            if($bookmark->owner_id != $userID) { return "This is not your bookmark"; }
            
            //Update the bookmark's title
            $bookmark->title = $request->page_title;
            $bookmark->colour = $request->colour;
            $bookmark->save();
            
            //Now create a new tag object for each of the tags
            //Only if it doesn't already exist in tags
            foreach($tags as $tag_name) {
                // Retrieve the tag by the attributes, or instantiate a new instance...
                $tag = Tag::firstOrNew(array('tag_name' => $tag_name));
                $tag->save();
                
                $bookmarkTag = BookmarkTag::firstOrNew(array(
                    'bookmark_id' => $bookmark->bookmark_id,
                    'tag_id' => $tag->tag_id
                ));
                $bookmarkTag->save();
            }
            
        } catch (ModelNotFoundException $e) {
            return "Bookmark not found: " . $e->getMessage();
        }
        
        return redirect($this->bookmarksPath);
    }
    
    /**
     * Get a validator for an incoming bookmark creation request.
     *
     * @param Array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'url' => 'required'
        ]);
    }
    
    protected function editValidator(array $data)
    {
        return Validator::make($data, [
            'page_title' => 'required',
            'tags' => 'required',
            'colour' => 'required'
        ]);
    }
    
    protected function create(array $data) {
        $userID = Auth::user()->id;
        
        //dd($data);
        
        return Bookmark::create([
            'owner_id' => $userID,
            'title' => $data['title'],
            'url' => $data['url'],
            'content' => $data['content'],
            'colour' => $data['colour'],
        ]);
    }
    
    /**
     * Handle a bookmark creation request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
    public function postCreate(Request $request) {
        //Make sure url and colour are provided (TODO: more validation, ie colour is a hex code)
        $validator = $this->validator($request->all());

        if ($validator->fails()) {
            $this->throwValidationException(
                $request, $validator
            );
        }
        
        //Now create a new RemotePage to pull the page data
        $page = new RemotePage($request->url);
        
        $data = $request->all();
        
        $data['title'] = $page->getTitle();
        $data['content'] = $page->getContent();
        
        //Insert a new Bookmark into db and return it's ID
        $bookmarkID = $this->create($data)->bookmark_id;
        
        //Redirect to edit page
        return redirect($this->bookmarkEditPath . $bookmarkID);
    }

}