@extends('includes.auth')

@section('content')
<div class="max-w-lg m-auto flex items-center rounded-lg shadow-xl justify-center bg-white py-12 px-4 sm:px-6 lg:px-8 mb-[8vh] mt-10">
    <div class="max-w-md w-full space-y-6">

      <div class="flex justify-center mb-2">
        <img src="https://verify.stinl.gov.kh/Images/stinl_logo.png" alt="" width="100" height="98" class="shadow-2xl shadow-[#646ac48a] hover:animate-none duration-1000 scale-95 rounded-full">
        <h2 class="mt-6 text-center text-2xl md:text-3xl font-extrabold text-gray-900">Register a new account</h2>
      </div>

  
      @if($errors->any())
        <div class="text-red-500 text-sm text-center">
          {{ $errors->first() }}
        </div>
      @endif
  
      <form class="mt-8 space-y-6 " method="POST" action="/register">
        @csrf
        <div class="rounded-md shadow-sm -space-y-px space-y-6">
          <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700 p-1">Full Name</label>
            <input name="name" type="text" required
              class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
              placeholder="Full Name">
          </div>
          <div class="mb-4">
            <label for="email" class="block text-sm font-medium text-gray-700 p-1">Email address</label>
            <input name="email" type="email" required
              class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
              placeholder="Email">
          </div>
          <div class="flex flex-row gap-2 mb-4">
            <div>
              <label for="password" class="block text-sm font-medium text-gray-700 p-1">Password</label>
              <input name="password" type="password" required
                class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                placeholder="Password">
            </div>

            <div>
              <label for="password_confirmation" class="block text-sm font-medium text-gray-700 p-1">Confirm Password</label>
              <input name="password_confirmation" type="password" required
                class="appearance-none rounded-md relative block w-full px-3 py-2 border border-gray-300 placeholder-gray-500 text-gray-900 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                placeholder="Confirm Password">
            </div>

          </div>
        </div>
  
        <div>
          <button type="submit"
            class="group relative w-full flex justify-center py-2 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
            Register
          </button>
        </div>
        <div class="flex justify-center gap-6 font-medium  text-[14px]">
            <span>Aready have an account?</span>
            <a href="{{ route('login') }}" class=" hover:underline duration-300 ease-out text-indigo-600 hover:text-indigo-500">Login!</a>
          </div>
      </form>
    </div>
  </div>
  @endsection