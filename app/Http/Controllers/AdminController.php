<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Stats;
use App\Article;
use App\Settings;
use App\Http\Requests;
use App\Http\Requests\AddRoleRequest;
use App\Http\Requests\AddStatsRequest;
use App\Http\Requests\UpdateStatsRequest;
use App\Http\Requests\AddArticleRequest;
use App\Http\Requests\UpdateArticleRequest;
use App\Http\Requests\UpdateWidgetSettingsRequest;
use Maatwebsite\Excel\Facades\Excel;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Show the Admin dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin');
    }

    /**
     * Get all publishers.
     *
     * @return Response
     */
    public function allPublishers()
    {
        $publishers = User::where('role', 'publisher')->orderBy('first_name')->get();

        return response()->json(['publishers' => $publishers]);
    }

    /**
     * Get all widget articles.
     *
     * @return Response
     */
    public function widgetArticles()
    {
        $widget_count = Settings::where('name', 'widget_count')->first();
        $articles = Article::widget()->active()->orderBy('id', 'desc')->get();

        return response()->json(['articles' => $articles]);
    }

    /**
     * Get all other articles.
     *
     * @return Response
     */
    public function otherArticles()
    {
        $articles = Article::nonwidget()->active()->orderBy('id', 'desc')->get();

        return response()->json(['articles' => $articles]);
    }

    /**
     * Get widget settings.
     *
     * @return Response
     */
    public function widgetSettings()
    {
        $widget_title = Settings::where('name', 'widget_title')->first();
        $widget_count = Settings::where('name', 'widget_count')->first();

        $articles = Article::widget()->active()->orderBy('id', 'desc')->limit($widget_count->value)->get();

        return response()->json(['widget_title' => $widget_title, 'widget_count' => $widget_count, 'articles' => $articles]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showPublisher($id)
    {
        $publisher = User::find($id);
        $stats = Stats::where('user_id', $id)->orderBy('date', 'DESC')->orderBy('id', 'DESC')->get();

        return response()->json(['publisher' => $publisher, 'stats' => $stats]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeStat(AddStatsRequest $request)
    {
        Stats::insert([
            'user_id' => $request->user_id,
            'date' => $request->date,
            'site' => $request->site,
            'impressions' => $request->impressions,
            'served' => $request->served,
            'income' => $request->income,
            'tag' => $request->tag
        ]);

        $publisher = User::find($request->user_id);

        return response()->json(['publisher' => $publisher]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Department\UpdateDepartmentRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateStat(UpdateStatsRequest $request, $id)
    {
        Stats::where('id', $id)
            ->update([
                'user_id' => $request->user_id, 
                'date' => $request->date, 
                'site' => $request->site, 
                'impressions' => $request->impressions, 
                'served' => $request->served, 
                'income' => $request->income, 
                'tag' => $request->tag, 
            ]);

        $publisher = User::find($request->user_id);

        return response()->json(['publisher' => $publisher]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeArticle(AddArticleRequest $request)
    {
        if ( $request->image ) {
            $path = Storage::putFile('public/articles', $request->file('image'));
            $path = str_replace('public', 'storage', $path);
        } else {
            $path = $request->image_url;
        }

        $article = new Article;

        $article->image_url = $path;
        $article->title = $request->title;
        $article->permalink = $request->permalink;
        $article->stats = json_encode(array(''));
        $article->active = 1;

        $article->save();

        return response()->json(['article' => $article]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Department\UpdateDepartmentRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateArticle(UpdateArticleRequest $request, $id)
    {
        if ( $request->image ) {
            $path = Storage::putFile('public/articles', $request->file('image'));
            $path = str_replace('public', 'storage', $path);
        } else {
            $path = $request->image_url;
        }

        $widget_count = Settings::where('name', 'widget_count')->first();
        $articles_in_widget = Article::widget()->active()->count();

        if ( $request->widget == 1 && $articles_in_widget == $widget_count->value ) {
            return response()->json(['confirm' => 'There are already the max allowed articles within the widget, if you proceed, we will remove the oldest article from the widget and add this one.', 'request' => $request->all(), 'article_id' => $id]);
        }

        $article = Article::find($id);

        $article->image_url = $path;
        $article->title = $request->title;
        $article->permalink = $request->permalink;
        $article->widget = $request->widget;
        $article->active = $request->active;

        $article->save();

        return response()->json(['article' => $article]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Department\UpdateDepartmentRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateConfirmedArticle(Request $request, $id)
    {
        if ( $request->image ) {
            $path = Storage::putFile('public/articles', $request->file('image'));
            $path = str_replace('public', 'storage', $path);
        } else {
            $path = $request->image_url;
        }
        
        $oldest_article = Article::widget()->active()->oldest()->first();
        $oldest_article->widget = 0;
        $oldest_article->save();

        $article = Article::find($id);

        $article->image_url = $path;
        $article->title = $request->title;
        $article->permalink = $request->permalink;
        $article->widget = $request->widget;
        $article->active = $request->active;

        $article->save();

        return response()->json(['article' => $article]);
    }

    /**
     * Upload the publishers stats.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function uploadStats(Request $request, $id)
    {
        $path = Storage::putFile('public/stats', $request->file('stats'));
        $path = str_replace('public', 'storage', $path);
        echo "ID: ".$id."<br/>";
        Excel::load($path, function($reader) use ($id) {
            $reader->each(function($sheet) use ($id) {
                $date = explode('/', $sheet->date);
                $year = $date[2];
                $month = $date[0];
                $day = $date[1];
                $date = Carbon::createFromDate($year, $month, $day);
                $site = $sheet->site;
                $impressions = $sheet->impressions;
                $served = $sheet->served;
                $income = $sheet->income;
                $tag = $sheet->tag;

                Stats::insert([
                    'user_id' => $id,
                    'date' => $date,
                    'site' => $site,
                    'impressions' => $impressions,
                    'served' => $served,
                    'income' => $income,
                    'tag' => $tag
                ]);
            });
        });
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Department\UpdateDepartmentRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateWidgetSettings(UpdateWidgetSettingsRequest $request)
    {
        $widget_title = Settings::updateOrCreate(
            ['name' => 'widget_title'],
            ['name' => 'widget_title', 'value' => $request->title]
        );

        $widget_count = Settings::updateOrCreate(
            ['name' => 'widget_count'],
            ['name' => 'widget_count', 'value' => $request->count]
        );

        if ( $widget_count->value == $request->count && $widget_title->value == $request->title ) {
            $articles = Article::active()->widget()->limit($widget_count->value)->get();

            return response()->json(['successful' => true, 'title' => $widget_title, 'articles' => $articles]);
        }

        return response()->json(['error' => true]);
    }
}
