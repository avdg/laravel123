<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class NewsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show a news article
     *
     * @param $id Id of news article to show
     *
     * @return \Illuminate\Http\Response
     */
    public function showNewsArticle($id)
    {
        $id = $this->checkValidArticleId($id);

        if ($id < 0) {
            return $this->fail();
        }

        $article = \App\News::find($id);

        if ($article === null) {
            return $this->fail();
        }

        return view('news.article', ["newsArticle" => $article[0]]);
    }

    /**
     * Show a page to create a news article
     *
     * @param Request $request Laravel request object
     *
     * @return \Illuminate\Http\Response
     */
    public function createNewsArticle(Request $request) {
        $postPublic = true;

        if (!$request->old("public") && $request->old("submit")) {
            $postPublic = false;
        }

        return view('news.edit', [
            "news"          => $request->old("news"),
            "postPublic"    => $postPublic,
            "title"         => "Create a new news article",
            "submitContent" => "Add new article"
        ]);
    }

    /**
     * Attempt to add a news article
     *
     * @param $id Id of news article to show
     *
     * @return \Illuminate\Http\Response
     */
    public function addNewsArticle(Request $request)
    {
        $validator = $this->validateNewsArticle($request);

        if ($validator->fails()) {
            return redirect('/news/create')
                ->withErrors($validator)
                ->withInput();
        }

        $article = new \App\News([
            'news' => $request->input("news"),
            'public' => !!$request->input("public")
        ]);
        $article->save();

        return redirect('/news');
    }

    /**
     * Show the welcome screen
     *
     * @param Request $request Laravel request object
     * @param String $id Id of the article to edit
     *
     * @return \Illuminate\Http\Response
     */
    public function editNewsArticle(Request $request, $id) {

        $id = $this->checkValidArticleId($id);

        if ($id < 0) {
            return $this->fail();
        }

        if ($request->old("submit")) {
            $article = new \stdClass();
                $article->news   = $request->old("news");
                $article->public = $request->old("public");
        } else {
            $article = \App\News::find($id);

            if ($article === null) {
                return $this->fail();
            }
        }


        return view('news.edit', [
            "news"          => $article->news,
            "postPublic"    => $article->public,
            "title"         => "Edit news article",
            "submitContent" => "Update article"
        ]);
    }

    /**
     * Show the welcome screen
     *
     * @param Request $request Laravel request object
     * @param String $id Id of the article to edit
     *
     * @return \Illuminate\Http\Response
     */
    public function processEdit(Request $request, $id) {
        $id = $this->checkValidArticleId($id);

        if ($id < 0) {
            return $this->fail();
        }

        $validator = $this->validateNewsArticle($request);

        if ($validator->fails()) {
            return redirect('/news/edit/' . $id)
                ->withErrors($validator)
                ->withInput();
        }

        $article = \App\News::find($id);
        $article->news = $request->input("news");
        $article->public = !!$request->input("public");
        $article->save();

        if ($article === null) {
            return $this->fail();
        }

        return redirect('/news');
    }

    /**
     * Request to delete an article
     *
     * @param String $id Id of the article to be delete
     *
     * @return \Illuminate\Http\Response
     */
    public function requestDelete($id) {
        $id = $this->checkValidArticleId($id);

        if ($id < 0) {
            return $this->fail();
        }

        $article = \App\News::find($id);

        if ($article === null) {
            return $this->fail();
        }

        return view("news.requestDelete", [
            "newsArticle" => $article
        ]);
    }

    /**
     * Actually remove a news article
     *
     * @param Request $request Laravel request object
     * @param String $id Id of the article to be deleted
     *
     * @return \Illuminate\Http\Response
     */
    public function confirmDelete(Request $request, $id) {
        $id = $this->checkValidArticleId($id);

        if ($id < 0) {
            return $this->fail();
        }

        \App\News::destroy($id);

        return redirect('/news');
    }

    /**
     * Get an overview of all articles
     *
     * @return \Illuminate\Http\Response
     */
    public function overviewArticles() {
        $news = \App\News::all()->sortByDesc("id");

        return view("news.overview", [
            "news" => $news
        ]);
    }

    /**
     * Check if the news article is valid
     *
     * @param Request $request Laravel request object
     *
     * @return boolean
     */
    public function validateNewsArticle(Request $request) {
        return \Validator::make($request->all(), [
            'news' => 'required|min:20',
            'public' => 'in:on'
        ]);
    }

    /**
     * Get the id of the news article, -1 if article isn't valid
     *
     * @param String $id Id to process
     *
     * @return Integer
     */
    public function checkValidArticleId(String $id) {
        if (!ctype_digit($id)) {
            return -1;
        }

        $id = intval($id);

        if ($id < 0) {
            return -1;
        }

        return $id;
    }

    /**
     * Page is unavailable
     *
     * @return \Illuminate\Http\Response
     */
    public function fail() {
        return response("Page unavailable", 404);
    }
}
