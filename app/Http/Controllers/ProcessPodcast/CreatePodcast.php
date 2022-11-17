<?php

namespace App\Http\Controllers\ProcessPodcast;

use App\Http\Controllers\Controller;
use App\Jobs\ProcessPodcast;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CreatePodcast extends Controller
{
    public function showForm() {
        return view('ProcessPodcast.createPodcast');
    }

    public function createPodcast() {
        $name = request()->userName;
        $password = request()->password;
        ProcessPodcast::dispatch($name, $password);

        echo "User created";
    }
}