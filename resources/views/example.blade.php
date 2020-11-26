<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <!-- <meta name="userId" content="{{ Auth::check() ? Auth::user()->id : ''}}"> -->

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta content="telephone=no" name="format-detection">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/1.3.5/tailwind.min.css">
  </head>
  <body>
    <div class="flex flex-col items-center">
      <x-testing title="My Testing" :info="$info" class="bg-gray-500">
      </x-testing>
    </div>
  </body>
</html>
