@extends('layouts.master')
@section('content')

<div id="list-id" class="jumbotron">

	<div class="form-group form-group-lg">
	  <input class="form-control fuzzy-search uni-search" type="text" id="search" placeholder="Ricerca corso per nome o referenti.">
	</div><hr>
	@for ($i = 0; $i < 10; $i++)
	<ul class="list" style="list-style-type:none; padding:0px;">
		@include('partials._course')
	</ul>
	@endfor
</div>

<script>

var fuzzyOptions = {
  searchClass: "fuzzy-search",
  location: 0,
  distance: 100,
  threshold: 0.4,
    multiSearch: true
};
var options = {
  valueNames: ['name','b_code','authors','price'],
  plugins: [
    ListFuzzySearch()
  ]
};

var listObj = new List('list-id', options);

</script>
@stop