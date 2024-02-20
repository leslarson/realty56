<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <title>Realty56</title>
        
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        
        <script src="https://kit.fontawesome.com/e49a2a4c71.js" crossorigin="anonymous"></script>

        <!-- Tom Select library - used for searchable select control on search page -->
        <link href="https://cdn.jsdelivr.net/npm/tom-select@2.0.0-rc.4/dist/css/tom-select.css" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/tom-select@2.0.0-rc.4/dist/js/tom-select.complete.min.js"></script>
    
            
        @vite(['resources/css/app.css'])
        @vite(['resources/js/app.js'])
        @vite(['resources/js/search.js'])

    </head>
    <body class="antialiased">
        <div id="header">    
            <div id="login-nav">
                <a href="/" class="emblem">
                    <h3>Realty<em style="color:blue;">56</em></h3>
                </a>
                @auth
                @isset($userfav)
                <div class="favmode">
                    Your <span style="color:red;">Favorites</span> - click <a href='/'>here</a> to return
                </div>
                @endisset
                    <div class="welcome">
                        Welcome, {{ auth()->user()->username }}!
                    </div>
                    <div id="useroptions">
                        <div class="ufavs">
                            @if (count($favorites))
                                <span id="fav-icon" class="fa-solid fa-heart hand-pointer"></span>
                            @else
                                <span id="fav-icon" class="fa-regular fa-heart"></span>
                            @endif
                        </div>
                        <div class="avacon">
                            <i class="fa-regular fa-user"></i>
                        </div>
                        <div>
                            <form action="/logout" method="POST" class="d-inline">
                                @csrf
                                <button  class="btn btn-sm btn-info">Sign Out</button>
                            </form>
                        </div>
                    </div>
                @else
                    <form action="/login" method="POST" class="mb-0 pt-2 pt-md-0">
                        @csrf
                        <div class="row align-items-center">
                        <div class="col-md mr-0 pr-md-0 mb-3 mb-md-0">
                            <input name="loginusername" class="form-control form-control-sm input-dark" type="text" placeholder="Username" autocomplete="off" />
                        </div>
                        <div class="col-md mr-0 pr-md-0 mb-3 mb-md-0">
                            <input name="loginpassword" class="form-control form-control-sm input-dark" type="password" placeholder="Password" />
                        </div>
                        <div class="col-md-auto">
                            <button class="btn btn-primary btn-sm">Sign In</button>
                        </div>
                        </div>
                    </form>
                @endauth
            </div>
        </div>