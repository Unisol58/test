@extends('layouts.app')

@section('content')
<div class="container">
  <div class="max-w-8xl mx-auto sm:px-8 lg:px-8">
               <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
                   <h2>Recipes</h2>
               </div>

               <div class="col-12 mt-8" id="app">
                 <recipes-item/>
               </div>
           </div>
       </div>
</div>
@endsection
