@extends('welcome')

@section('title', 'Login  - Wargalima CMS')

@section('content')
<div class="flex items-center justify-center grow bg-center bg-no-repeat page-bg">
  <div class="card max-w-[370px] w-full">
  <form action="{{ route('sign-in') }}" class="card-body flex flex-col gap-5 p-10" id="sign_in_form" method="POST">
    @csrf
    <div class="text-center mb-2.5">
    <h3 class="text-lg font-medium text-gray-900 leading-none mb-2.5">
      Sign in
    </h3>
    <div class="flex items-center justify-center font-medium">
      <span class="text-2sm text-gray-700 me-1.5">
      Need an account?
      </span>
      <a class="text-2sm link" href="html/demo1/authentication/classic/sign-up.html">
      Sign up
      </a>
    </div>
    </div>
    <div class="grid grid-cols-2 gap-2.5">
    <a class="btn btn-light btn-sm justify-center" href="#">
      <img alt="" class="size-3.5 shrink-0" src="assets/media/brand-logos/google.svg"/>
      Use Google
    </a>
    <a class="btn btn-light btn-sm justify-center" href="#">
      <img alt="" class="size-3.5 shrink-0 dark:hidden" src="assets/media/brand-logos/apple-black.svg"/>
      <img alt="" class="size-3.5 shrink-0 light:hidden" src="assets/media/brand-logos/apple-white.svg"/>
      Use Apple
    </a>
    </div>
    <div class="flex items-center gap-2">
    <span class="border-t border-gray-200 w-full">
    </span>
    <span class="text-2xs text-gray-500 font-medium uppercase">
      Or
    </span>
    <span class="border-t border-gray-200 w-full">
    </span>
    </div>
    <div class="flex flex-col gap-1">
    <label class="form-label font-normal text-gray-900">
      Username
    </label>
    <input class="input" placeholder="Enter Username" type="text" name="username" value=""/>
    </div>
    <div class="flex flex-col gap-1">
    <div class="flex items-center justify-between gap-1">
      <label class="form-label font-normal text-gray-900">
      Password
      </label>
    </div>
    <div class="input" data-toggle-password="true">
      <input placeholder="Enter Password" name="password" type="password" value=""/>
      <button class="btn btn-icon" data-toggle-password-trigger="true" type="button">
      <i class="ki-filled ki-eye text-gray-500 toggle-password-active:hidden">
      </i>
      <i class="ki-filled ki-eye-slash text-gray-500 hidden toggle-password-active:block">
      </i>
      </button>
    </div>
    </div>
    <button class="btn btn-primary flex justify-center grow">
    Sign In
    </button>
  </form>
  </div>
</div>
@endsection
