<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Visitor;
use App\Models\Page;
use App\Models\User;

class HomeController2 extends Controller
{
    public function __invoke() {
        $this->middleware('auth');
    }
    public function index(Request $request) {
        $visitsCount = 0;
        $onlineCount = 0;
        $pageCount = 0;
        $userCount = 0;
        $interval = intval($request->input('interval', 30));

        if($interval > [120]) {
            $interval = 120;
        }

        // Contagem de Visitantes
        $visitsCount = Visitor::count();
        //$dateInterval = date('Y-m-d H:i:s', strtotime('-'.$interval.'days'));
        //$visitsCount = Visitor::select('date_acess', $dateInterval)->count();

        // Contagem de Usuários Online
        $datelimit = date('Y-m-d H:i:s', strtotime('-5 minutes'));
        $onlineList = Visitor::select('ip')->where('ip', '>=', $datelimit)->groupBy('ip')->get();
        $onlineCount = count($onlineList);

        // Contagem de Páginas
        $pageCount = Page::count();

        // Contagem de Usuários
        $userCount = User::count();

        // Contagem para o PagePie
        $pagePie = [];
        $visitsAll = Visitor::selectRaw('page, count(page) as c')
        //->select('date_acess', $dateInterval)
        ->groupBy('page')
        ->get();
        
        foreach($visitsAll as $visit) {
            $pagePie[ $visit['page'] ] = intval($visit['c']);
        }

        $pageLabels = json_encode( array_keys($pagePie) );
        $pageValues = json_encode( array_values($pagePie) );

        return view('admin.home', [
            'visitsCount' => $visitsCount,
            'onlineCount' => $onlineCount,
            'pageCount' => $pageCount,
            'userCount' => $userCount,
            'pageLabels' => $pageLabels,
            'pageValues' => $pageValues
        ]);
    }
}