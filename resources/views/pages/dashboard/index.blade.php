@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
    <main class="grow content pt-5" id="content" role="content">
     <!-- Container -->
     <div class="container-fixed" id="content_container">
     </div>
     <!-- End of Container -->
     <!-- Container -->
     <div class="container-fixed">
      <div class="flex flex-wrap items-center lg:items-end justify-between gap-5 pb-7.5">
       <div class="flex flex-col justify-center gap-2">
        <h1 class="text-xl font-medium leading-none text-gray-900">
         Dashboard
        </h1>
        <div class="flex items-center gap-2 text-sm font-normal text-gray-700">
         Central Hub for Personal Customization
        </div>
       </div>
       <div class="flex items-center gap-2.5">
        <a class="btn btn-sm btn-light" href="html/demo1/public-profile/profiles/default.html">
         View Profile
        </a>
       </div>
      </div>
     </div>
     <!-- End of Container -->
     <!-- Container -->
     <div class="container-fixed">
      <div class="grid gap-5 lg:gap-7.5">
       <!-- begin: grid -->
       <div class="grid lg:grid-cols-3 gap-y-5 lg:gap-7.5 items-stretch">
        <div class="lg:col-span-1">
         <div class="grid grid-cols-2 gap-5 lg:gap-7.5 h-full items-stretch">
          <style>
           .channel-stats-bg {
		background-image: url('assets/media/images/2600x1600/bg-3.png'); }
               .dark .channel-stats-bg {
                    background-image: url('assets/media/images/2600x1600/bg-3-dark.png');
               }
          </style>
          <div class="card flex-col justify-between gap-6 h-full bg-cover rtl:bg-[left_top_-1.7rem] bg-[right_top_-1.7rem] bg-no-repeat channel-stats-bg">
           <img alt="" class="w-7 mt-4 ms-5" src="assets/media/brand-logos/linkedin-2.svg"/>
           <div class="flex flex-col gap-1 pb-4 px-5">
            <span class="text-3xl font-semibold text-gray-900">
             9.3k
            </span>
            <span class="text-2sm font-normal text-gray-700">
             Amazing mates
            </span>
           </div>
          </div>
          <div class="card flex-col justify-between gap-6 h-full bg-cover rtl:bg-[left_top_-1.7rem] bg-[right_top_-1.7rem] bg-no-repeat channel-stats-bg">
           <img alt="" class="w-7 mt-4 ms-5" src="assets/media/brand-logos/youtube-2.svg"/>
           <div class="flex flex-col gap-1 pb-4 px-5">
            <span class="text-3xl font-semibold text-gray-900">
             24k
            </span>
            <span class="text-2sm font-normal text-gray-700">
             Lessons Views
            </span>
           </div>
          </div>
          <div class="card flex-col justify-between gap-6 h-full bg-cover rtl:bg-[left_top_-1.7rem] bg-[right_top_-1.7rem] bg-no-repeat channel-stats-bg">
           <img alt="" class="w-7 mt-4 ms-5" src="assets/media/brand-logos/instagram-03.svg"/>
           <div class="flex flex-col gap-1 pb-4 px-5">
            <span class="text-3xl font-semibold text-gray-900">
             608
            </span>
            <span class="text-2sm font-normal text-gray-700">
             New subscribers
            </span>
           </div>
          </div>
          <div class="card flex-col justify-between gap-6 h-full bg-cover rtl:bg-[left_top_-1.7rem] bg-[right_top_-1.7rem] bg-no-repeat channel-stats-bg">
           <img alt="" class="dark:hidden w-7 mt-4 ms-5" src="assets/media/brand-logos/tiktok.svg"/>
           <img alt="" class="light:hidden w-7 mt-4 ms-5" src="assets/media/brand-logos/tiktok-dark.svg"/>
           <div class="flex flex-col gap-1 pb-4 px-5">
            <span class="text-3xl font-semibold text-gray-900">
             2.5k
            </span>
            <span class="text-2sm font-normal text-gray-700">
             Stream audience
            </span>
           </div>
          </div>
         </div>
        </div>
        <div class="lg:col-span-2">
         <style>
          .entry-callout-bg {
		background-image: url('assets/media/images/2600x1600/2.png');
	}
	.dark .entry-callout-bg {
		background-image: url('assets/media/images/2600x1600/2-dark.png');
	}
         </style>
         <div class="card h-full">
          <div class="card-body p-10 bg-[length:80%] rtl:[background-position:-70%_25%] [background-position:175%_25%] bg-no-repeat entry-callout-bg">
           <div class="flex flex-col justify-center gap-4">
            <div class="flex -space-x-2">
             <div class="flex">
              <img class="hover:z-5 relative shrink-0 rounded-full ring-1 ring-light-light size-10" src="assets/media/avatars/300-4.png"/>
             </div>
             <div class="flex">
              <img class="hover:z-5 relative shrink-0 rounded-full ring-1 ring-light-light size-10" src="assets/media/avatars/300-1.png"/>
             </div>
             <div class="flex">
              <img class="hover:z-5 relative shrink-0 rounded-full ring-1 ring-light-light size-10" src="assets/media/avatars/300-2.png"/>
             </div>
             <div class="flex">
              <span class="hover:z-5 relative inline-flex items-center justify-center shrink-0 rounded-full ring-1 font-semibold leading-none text-3xs size-10 text-success-inverse text-xs ring-success-light bg-success">
               S
              </span>
             </div>
            </div>
            <h2 class="text-1.5xl font-semibold text-gray-900">
             Connect Today & Join
             <br/>
             the
             <a class="link" href="#">
              KeenThemes Network
             </a>
            </h2>
            <p class="text-sm font-normal text-gray-700 leading-5.5">
             Enhance your projects with premium themes and
             <br/>
             templates. Join the KeenThemes community today
             <br/>
             for top-quality designs and resources.
            </p>
           </div>
          </div>
          <div class="card-footer justify-center">
           <a class="btn btn-link" href="html/demo1/account/home/get-started.html">
            Get Started
           </a>
          </div>
         </div>
        </div>
       </div>
       <!-- end: grid -->
      </div>
     </div>
     <!-- End of Container -->
    </main>
@endsection