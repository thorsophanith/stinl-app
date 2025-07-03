@extends('includes.auth')

@section('content')
<div class="flex w-[100%] items-center m-auto shadow-xl rounded-lg justify-center bg-white py-7 md:py-12 px-8 sm:px-8 lg:px-8">


  <div class="space-y-8">

    <div class="flex justify-center mb-2">
    <img src="https://verify.stinl.gov.kh/Images/stinl_logo.png" alt="" width="120" height="118" class="shadow-2xl shadow-[#646ac48a] hover:animate-none duration-1000 scale-95 rounded-full">
    </div>

    <div>
      <h2 class="mt-6 text-center text-2xl md:text-3xl font-extrabold text-gray-900">Login to your account</h2>
    </div>

    @if($errors->any())
      <div class="text-red-500 text-sm text-center">
        {{ $errors->first() }}
      </div>
    @endif

    <form class="mt-8 space-y-6" method="POST" action="/login">
      @csrf
      <div class="rounded-md shadow-sm -space-y-px">
        <div class="mb-4">
          <label for="email" class="block text-sm font-medium text-gray-700 p-1">Email address</label>
          <input name="email" type="email" autocomplete="email" required
            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
            placeholder="Email">
        </div>
        <div>
          <label for="password" class="block text-sm font-medium text-gray-700 p-1">Password</label>
          <input name="password" type="password" autocomplete="current-password" required
            class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
            placeholder="Password">
        </div>
      </div>

      <div class="flex items-center justify-between">
        <div class="text-sm">
          <a href="/forgot-password" class="font-medium text-indigo-600 hover:text-indigo-500">Forgot your password?</a>
        </div>
      </div>

      <div>
        <button type="submit"
          class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
          Login
        </button>
      </div>
      <div class="flex justify-center gap-6 font-medium  text-[14px]">
        <span>Don`t have account?</span>
        <a href="{{ route('register') }}" class=" hover:underline duration-300 ease-out text-indigo-600 hover:text-indigo-500">Register New Account!</a>
      </div>
    </form>
  </div>
</div>
@endsection
