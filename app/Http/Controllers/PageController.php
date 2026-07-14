<?php

namespace App\Http\Controllers;

use Illuminate\View\View;

class PageController extends Controller
{
    public function alerts(): View
    {
        return view('pages.alert', [
            'pageTitle' => 'Early Warning Alerts',
            'activePage' => 'alerts',
            'hideSidebar' => false,
        ]);
    }

    public function dashboard(): View
    {
        return view('pages.dashboard', [
            'pageTitle' => 'PowerGuard Dashboard',
            'activePage' => 'home',
            'hideSidebar' => false,
        ]);
    }

    public function default(): View
    {
        return view('pages.default', [
            'pageTitle' => 'Default',
            'activePage' => '',
            'hideSidebar' => true,
        ]);
    }

    public function goals(): View
    {
        return view('pages.goals', [
            'pageTitle' => "This Week's Goals",
            'activePage' => 'goals',
            'hideSidebar' => false,
        ]);
    }

    public function home(): View
    {
        return view('pages.dashboard', [
            'pageTitle' => 'PowerGuard Dashboard',
            'activePage' => 'home',
            'hideSidebar' => false,
        ]);
    }

    public function manageAccess(): View
    {
        return view('pages.manage-access', [
            'pageTitle' => 'Family & Teachers',
            'activePage' => 'manage-access',
            'hideSidebar' => false,
        ]);
    }

    public function login(): View
    {
        return view('pages.login', [
            'pageTitle' => 'PowerGuard Login',
            'activePage' => '',
            'hideSidebar' => true,
        ]);
    }

    public function signup(): View
    {
        return view('pages.signup', [
            'pageTitle' => 'PowerGuard Register',
            'activePage' => '',
            'hideSidebar' => true,
        ]);
    }

    public function reports(): View
    {
        return view('pages.report', [
            'pageTitle' => 'Progress Reports',
            'activePage' => 'reports',
            'hideSidebar' => false,
        ]);
    }

    public function rewards(): View
    {
        return view('pages.rewards', [
            'pageTitle' => 'Rewards & Motivation',
            'activePage' => 'rewards',
            'hideSidebar' => false,
        ]);
    }

    public function studentProfile(): View
    {
        return view('pages.student-profile', [
            'pageTitle' => 'Edit Student Profile',
            'activePage' => 'home',
            'hideSidebar' => false,
        ]);
    }

    public function teacherFeedback(): View
    {
        return view('pages.teacher-feedback', [
            'pageTitle' => 'Teacher Pulse Checks',
            'activePage' => 'teacher-feedback',
            'hideSidebar' => false,
        ]);
    }

}
