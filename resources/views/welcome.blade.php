@extends('layouts.app')

@section('title', 'Home | Nigeria-Japan Chamber of Commerce')

@section('content')
  <x-home.hero />
  <x-home.president-message />
  <x-home.vision-mission />
    <x-home.principles />
      <x-home.approach />
          <x-home.investor-services />
          <x-home.resources-teaser  :latest-posts="$latestPosts"/>
    <x-home.get-in-touch     /> 
<x-home.latest-posts-modal :latest-posts="$latestPosts" />
@endsection