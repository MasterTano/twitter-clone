<template>
  <div class="flex justify-between m-auto min-h-screen xl:max-w-screen-xl bg-secondary text-white">
    <section class="w-2/12 min-w- min-h-full">
      <div class="mt-10">
        <a class="block my-10 mx-5" href="#">
          <span class="space-x-3 text-blue-400"><i class="fab fa-twitter text-2xl text-white"></i></span>
        </a>
      </div>
      <nav class="block">
        <a class="block my-8 mx-5 text-primary" href="#">
          <span class="space-x-3 text-blue-400"><i class="fas fa-home text-2xl text-primary"></i></span>
          <h1 class="inline-block font-bold text-xl ml-4">Home</h1>
        </a>
        <a class="block my-8 mx-5" href="#">
          <span class="space-x-3 text-blue-400"><i class="fas fa-hashtag text-2xl text-white"></i></span>
          <h1 class="inline-block font-bold text-xl ml-4">Explore</h1>
        </a>
        <a class="block my-8 mx-5" href="#">
          <span class="space-x-3 text-blue-400"><i class="far fa-bell text-2xl text-white"></i></span>
          <h1 class="inline-block font-bold text-xl ml-4">Notifications</h1>
        </a>
        <a class="block my-8 mx-5" href="#">
          <span class="space-x-3 text-blue-400"><i class="far fa-envelope text-2xl text-white"></i></span>
          <h1 class="inline-block font-bold text-xl ml-4">Messages</h1>

        </a>
        <a class="block my-8 mx-5" href="#">
          <span class="space-x-3 text-blue-400"><i class="far fa-user text-2xl text-white"></i></span>
          <h1 class="inline-block font-bold text-xl ml-4">Profile</h1>
        </a>
        <a class="block my-8 mx-5" href="#">
          <span class="space-x-3 text-blue-400"><i class="far fa-arrow-alt-circle-down text-2xl text-white"></i></span>
          <h1 class="inline-block font-bold text-xl ml-4">More</h1>
        </a>
      </nav>
    </section>

    <section class="flex-col w-6/12 min-h-full border border-dark-gray text-white">
        <div class="flex justify-between border-b border-dark-gray p-4">
          <div>
            <a href="#">Home</a>
          </div>
          <div>
            <span class="text-blue-400"><i class="far fa-sun text-lg"></i></span>
          </div>
        </div>

        <!--   Input new Tweet section     -->
        <div class="p-4 border-b-8 border-dark-gray">
          <div class="flex justify-between">
            <div class="flex-shrink-0">
              <span class="text-blue-400"><i class="far fa-user-circle text-lg red-1"></i></span>
            </div>
            <div class="flex-grow">
              <div class="flex-col px-2">
                <textarea class="min-w-full bg-transparent box-shadow-none outline-none"
                          cols="30"
                          placeholder="What's happening?"
                >
                </textarea>
              </div>

              <div class="flex px-2 justify-between border-yellow-400">
                <div>
                  <span class="mr-3 text-blue-400 text-xl"><i class="far fa-image red-1"></i></span>
                  <span class="mr-3 text-blue-400 text-xl"><i class="far fa-square red-1"></i></span>
                  <span class="mr-3 text-blue-400 text-xl"><i class="far fa-chart-bar red-1"></i></span>
                  <span class="mr-3 text-blue-400 text-xl"><i class="far fa-smile red-1"></i></span>
                </div>

                <div>
                  <button type="button" class="bg-primary rounded-full px-5 py-2 text-sm">Tweet</button>
                </div>
              </div>

            </div>
          </div>
        </div>

        <!--   Tweets Here   -->
        <!--   Tweets Here   -->
        <!--   Tweets Here   -->
      <div class="p-4">
        <div class="flex justify-between">
          <div class="flex-shrink-0">
            <span class="text-blue-400"><i class="far fa-user-circle text-lg red-1"></i></span>
          </div>

          <!-- Tweet Content Block Here -->
          <div class="flex-grow">

            <!-- Tweet Details Here -->
            <div class="flex-col px-2">
              <div>
                <div>
                  <a href="#" class="">Cristian Cardino</a>
                  <a href="#" class="text-light-gray ml-2">
                    <span>@cristiancardino</span>
                    <span class="mx-1">&middot;</span>
                    <span>20h</span>
                  </a>
                </div>
              </div>

            </div>

            <!-- Tweet Text Content Here-->
            <div class="flex-col px-2">
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Velit aliquet sagittis id consectetur. Quis viverra nibh cras pulvinar mattis nunc.
                </p>
            </div>

            <!-- Tweet Media Here -->
            <div class="min-w-full mt-2">
              <img class="rounded-lg" src="https://picsum.photos/600/300" alt="media_here">
            </div>

            <div class="flex py-2 justify-between border-yellow-400">
              <!--  Action Buttons Here  -->
                <div class="flex justify-between min-w-full">
                  <a href="#" class="text-light-gray text-sm"><i class="far fa-comment red-1"></i></a>
                  <a href="#" class="text-light-gray text-sm"><i class="fas fa-retweet red-1"></i></a>
                  <a href="#" class="text-light-gray text-sm"><i class="far fa-heart red-1"></i></a>
                  <a href="#" class="text-light-gray text-sm"><i class="fa fa-external-link-alt red-1"></i></a>
                  <div class="flex-shrink"></div>
                </div>
            </div>

          </div>
        </div>
      </div>
    </section>

    <section class="flex flex-grow-0 w-4/12 min-h-full">
      <div>
        <h1>Right Nav Here</h1>
      </div>
    </section>
  </div>
</template>

<script>
export default {
  name: "App",
  components: {}
};
</script>

<style>
</style>
