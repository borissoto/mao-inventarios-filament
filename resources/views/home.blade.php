
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MAO Importaciones</title>
    <meta name="author" content="MAO Importaciones">
    <meta name="description" content="Mao Importaciones">

    <!-- Tailwind -->
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.css" rel="stylesheet"> --}}
    {{-- <script src="https://cdn.tailwindcss.com"></script> --}}
    <link rel="stylesheet" href="{{asset('css/style.css')}}"/>  
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.1/dist/cdn.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    {{-- <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">  --}}
    {{-- @vite('resources/css/filament/admin/theme.css') --}}
    {{-- @vite('resources/css/style.css') --}}
     
   
</head>
{{-- <body class="bg-white tracking-wider"> --}}
<body 
  x-data="{navbarOpen: false, scrolledFromTop: false}" 
  x-init="window.pageYOffset > 60 ? scrolledFromTop = true : scrolledFromTop = false"
  @scroll.window="window.pageYOffset > 60 ? scrolledFromTop = true: scrolledFromTop = false"
  :class="{'overflow-hidden': navbarOpen, 'overflow-auto': !navbarOpen }"
  >
  <header class="fixed w-full bg-white flex justify-between items-center px-4 md:px-12 h-24 transition-all duration-200" :class="{'h-24': !scrolledFromTop, 'h-12': scrolledFromTop}">
    <a href="#">
      <span class="text-blue-400 font-bold text-3xl transition-all duration-200" :class="{'text-3xl': !scrolledFromTop, 'text-2xl': scrolledFromTop}">MĀO</span>
      <span class="text-gray-400 text-2xl transition-all duration-200" :class="{'text-2xl': !scrolledFromTop, 'text-xl': scrolledFromTop}">Importaciones</span>
    </a>
    <nav>
      <button class="md:hidden" @click="navbarOpen = !navbarOpen">
        <i class="fa-solid fa-bars"></i>
      </button>
      <ul class="fixed left-0 right-0 min-h-screen bg-white space-y-20 text-center transform translate-x-full transition duration-200
      md:relative md:flex md:min-h-0 md:space-y-0 md:space-x-6 md:p-0 md:translate-x-0" :class="{'translate-x-full': !navbarOpen, 'translate-x-0': navbarOpen}">
        <li><a href="#"></a></li>
        <li><a href="#hero" @click="navbarOpen = false" class="hover:text-blue-400 ease-in duration-200">Inicio</a></li>
        <li><a href="#history" @click="navbarOpen = false" class="hover:text-blue-400 ease-in duration-200">Quienes Somos?</a></li>
        <li><a href="#products" @click="navbarOpen = false" class="hover:text-blue-400 ease-in duration-200">Productos</a></li>
        {{-- <li><a href="{{ route('home.catalog') }}"  @click="navbarOpen = false" class="hover:text-blue-400 ease-in duration-200">Productos</a></li> --}}
        @auth
          @php
              $user = Auth::user();    
          @endphp
          <li><a href="{{ url('/admin') }}" class="bg-purple-400 text-white px-9 py-3 rounded-md hover:opacity-80 ease-in duration-200">Volver a Administracion</a></li>
        @else 
          <li><a href="{{ url('/login') }}" class="bg-blue-400 text-white px-9 py-3 rounded-md hover:opacity-80 ease-in duration-200">Inicio Sesion</a></li>
        @endauth  

      </ul>
    </nav>
  </header>
    
  <section id="hero" class="pt-32 pb-16 px-8 md:px-12 bg-blue-400">
    <div class="max-w-7xl mx-auto md:flex md:items-center md:justify-between">
       <div class="md:flex-1 md:mr-48">
          <h1 class="font-bold text-2xl md:text-4xl text-white leading-tight">
            ¡Desata la Diversión: Donde Cada Producto Cuenta una Historia!
          </h1>
          <p class="mt-4 text-base md:text-lg text-white ">
            Descubre el Mundo de la Fantasía y el Entretenimiento. Inspira Sueños y Crea Aventuras Sin Fin.
          </p>
       </div>
       <div class="md:flex-1">
          {{-- <img
             src="https://res.cloudinary.com/thirus/image/upload/v1632162912/logos/chat_ys7mog.svg"
             alt="Chat with loved ones"
          /> --}}
          <img class="w-5/6 h-5/6 sm:w-3/4 sm:h-3/4 md:w-3/4 md:h-3/4 rounded-3xl" src="{{asset('/img/toystore4.jpg')}}" alt="" />
       </div>
    </div>
 </section>

   <!-- Hero -->
      <section id="history" class="min-h-screen pt-12">
        {{-- <div class="container py-20 flex flex-col-reverse lg:flex-row items-center gap-12 mt-14 lg:mt-28"> --}}
          <div class="max-w-7xl mx-auto md:flex md:items-center md:justify-between">
          <!-- Content -->
              <div class="md:flex-1 md:mr-48">
              <h1 class="font-bold text-1xl md:text-4xl leading-tight">
                Quienes Somos?
              </h1>
              <p class="mt-4 text-sm md:text-lg">
                Somos una empresa lider en el mercado nacional. Fundada en 2010, 
                  nuestra tienda de juguetes ha sido un destino querido para niños y familias en El Alto La Paz, Bolivia. 
                  Ubicada en el corazón de la ciudad, nuestra tienda ofrece una amplia gama de juguetes, desde los 
                  clásicos favoritos hasta las últimas tendencias. A lo largo de los años, nos hemos convertido 
                  en una parte apreciada de la comunidad, conocida por nuestro personal amable y un ambiente acogedor. 
                  Nuestras estanterías están llenas de juguetes educativos, figuras de acción, muñecas y juegos 
                  que satisfacen a todas las edades. Nos enorgullecemos de ofrecer productos de alta calidad 
                  que fomentan la creatividad y la alegría. Las coloridas exhibiciones y las secciones interactivas 
                  hacen que comprar sea una experiencia encantadora tanto para niños como para adultos. 
                  Eventos especiales y promociones estacionales añaden emoción, haciendo que cada visita sea única. 
                  Nuestro compromiso con la satisfacción del cliente y la participación comunitaria nos ha ayudado 
                  a crecer y prosperar durante la última década. Visítenos y descubra por qué somos 
                  la tienda de juguetes preferida para la diversión y el aprendizaje.
              </p>
          </div>
         
          <!-- Image -->
          <div class="flex justify-center flex-1 mb-10 md:mb-16 lg:mb-0">
            <img class="w-5/6 h-5/6 sm:w-3/4 sm:h-3/4 md:w-full md:h-full rounded-3xl" src="{{asset('/img/toystore1.jpg')}}" alt="" />
          </div>
        </div>
      </section>
      
   <!-- FAQ -->
   {{-- <section id="products" class="min-h-screen">
    <div class="container py-20">

    </div>
  </section> --}}
  <section id="products" class="min-h-screen pt-12">
    @livewire('home-catalog' )
  </section>
  
  <!-- Footer -->
      <footer class="bg-bookmark-blue py-8">
        <div class="container flex flex-col md:flex-row items-center">
          <div class="flex flex-1 flex-wrap items-center justify-center md:justify-start gap-12 text-white">
            El Alto - Bolivia
            @by borrison
          </div>
          <div class="flex gap-10 mt-12 md:mt-0">
            <li><i class="text-white text-2xl fab fa-tiktok"></i></li>
            <li><i class="text-white text-2xl fab fa-facebook-square"></i></li>
          </div>
        </div>
      </footer>
  {{-- <main> --}}

    <!-- Top Bar Nav -->
    {{-- <nav class="w-full py-6 bg-orange-400 shadow">
        <div class="w-full container mx-auto flex flex-wrap items-center justify-between">

            <div class="flex items-center text-lg no-underline text-white pr-6">
                <a class="" href="#">
                    <i class="fab fa-facebook"></i>
                </a>
                <a class="pl-6" href="#">
                    <i class="fab fa-instagram"></i>
                </a>
                <a class="pl-6" href="#">
                    <i class="fab fa-tiktok"></i>
                </a>
              
            </div>

            <nav>
                <ul class="flex items-center justify-between font-bold text-xs text-white uppercase no-underline">
                    <li><a class="hover:text-gray-200 hover:underline px-4" href="#">Acerca</a></li>
                    @auth
                        @php
                            $user = Auth::user();    
                        @endphp
                        
                            <li><span>Bienvenid@  {{$user->name}}, volver a </span> <a class="hover:text-gray-200 hover:underline text-purple-800" href="{{ url('/admin') }}">Administracion </a></li>
                        </div>
                    @else 
                        <li><a class="hover:text-gray-200 hover:underline px-4" href="{{ url('/login') }}">Inicio Sesion</a></li>
                    @endauth   
                </ul>
            </nav>

          
        </div>

    </nav> --}}

    {{-- <header>
        <nav class="container flex items-center py-4 mt-4 sm:mt-12">
          <div class="py-1"><img src="/img/logo-bookmark.svg" alt="" /></div>
          <ul class="hidden sm:flex flex-1 justify-end items-center gap-12 text-bookmark-blue uppercase text-xs">
            <li class="cursor-pointer">Features</li>
            <li class="cursor-pointer">Pricing</li>
            <li class="cursor-pointer">Contact</li>
            <button type="button" class="bg-bookmark-red text-white rounded-md px-7 py-3 uppercase">Login</button>
          </ul>
          <div class="flex sm:hidden flex-1 justify-end">
            <i class="text-2xl fas fa-bars"></i>
          </div>
        </nav>
      </header> --}}
  
      <!-- Hero -->
      {{-- <section class="relative">
        <div class="container flex flex-col-reverse lg:flex-row items-center gap-12 mt-14 lg:mt-28">
          <!-- Content -->
          <div class="flex flex-1 flex-col items-center lg:items-start">
            <h2 class="text-bookmark-blue text-3xl md:text-4 lg:text-5xl text-center lg:text-left mb-6">
              MAO Importaciones
            </h2>
            <p class="text-bookmark-grey text-lg text-center lg:text-left mb-6">
              Somos una empresa lider en el mercado nacional.
            </p>
            <div class="flex justify-center flex-wrap gap-6">
              <button class="bg-blue-500 hover:bg-purple-300 text-white font-bold py-2 px-4 rounded">
                Android
              </button>
              <button class="bg-blue-700 hover:bg-purple-400 text-white font-bold py-2 px-4 rounded">
                iOS
              </button>
            </div>
          </div>
          <!-- Image -->
          <div class="flex justify-center flex-1 mb-10 md:mb-16 lg:mb-0 z-10">
            <img class="w-5/6 h-5/6 sm:w-3/4 sm:h-3/4 md:w-full md:h-full rounded-3xl" src="{{asset('/img/toystore1.jpg')}}" alt="" />
          </div>
        </div>
        <!-- Rounded Rectangle -->
        <div
          class="
            hidden
            md:block
            overflow-hidden
            bg-bookmark-purple
            rounded-l-full
            absolute
            h-80
            w-2/4
            top-32
            right-0
            lg:
            -bottom-28
            lg:-right-36
          "
        ></div>
      </section> --}}
    
      <!-- Features -->
      {{-- <section class="bg-bookmark-white py-20 mt-20 lg:mt-60">
        <!-- Heading -->
        <div class="sm:w-3/4 lg:w-5/12 mx-auto px-2">
          <h1 class="text-3xl text-center text-bookmark-blue">Features</h1>
          <p class="text-center text-bookmark-grey mt-4">
            Our aim is to make it quick and easy for you to access your favourite websites. Your bookmarks sync between
            your devices so you can access them on the go.
          </p>
        </div>
        <!-- Feature #1 -->
        <div class="relative mt-20 lg:mt-24">
          <div class="container flex flex-col lg:flex-row items-center justify-center gap-x-24">
            <!-- Image -->
            <div class="flex flex-1 justify-center z-10 mb-10 lg:mb-0">
              <img
                class="w-5/6 h-5/6 sm:w-3/4 sm:h-3/4 md:w-full md:h-full"
                src="{{asset('/img/illustration-features-tab-1.png')}}"
                alt=""
              />
            </div>
            <!-- Content -->
            <div class="flex flex-1 flex-col items-center lg:items-start">
              <h1 class="text-3xl text-bookmark-blue">Bookmark in one click</h1>
              <p class="text-bookmark-grey my-4 text-center lg:text-left sm:w-3/4 lg:w-full">
                Organize your bookmarks however you like. Our simple drag-and-drop interface gives you complete control
                over how you manage your favourite sites.
              </p>
              <button type="button" class="btn btn-purple hover:bg-bookmark-white hover:text-black">More Info</button>
            </div>
          </div>
          <!-- Rounded Rectangle -->
          <div
            class="
              hidden
              lg:block
              overflow-hidden
              bg-bookmark-purple
              rounded-r-full
              absolute
              h-80
              w-2/4
              -bottom-24
              -left-36
            "
          ></div>
        </div>
        <!-- Feature #2 -->
        <div class="relative mt-20 lg:mt-52">
          <div class="container flex flex-col lg:flex-row-reverse items-center justify-center gap-x-24">
            <!-- Image -->
            <div class="flex flex-1 justify-center z-10 mb-10 lg:mb-0">
              <img
                class="w-5/6 h-5/6 sm:w-3/4 sm:h-3/4 md:w-full md:h-full"
                src="{{ asset('img/illustration-features-tab-2.png')}}"
                alt=""
              />
            </div>
            <!-- Content -->
            <div class="flex flex-1 flex-col items-center lg:items-start">
              <h1 class="text-3xl text-bookmark-blue">Intelligent search</h1>
              <p class="text-bookmark-grey my-4 text-center lg:text-left sm:w-3/4 lg:w-full">
                Our powerful search feature will help you find saved sites in no time at all. No need to crawl through all
                of your bookmarks.
              </p>
              <button type="button" class="btn btn-purple hover:bg-bookmark-white hover:text-black">More Info</button>
            </div>
          </div>
          <!-- Rounded Rectangle -->
          <div
            class="
              hidden
              lg:block
              overflow-hidden
              bg-bookmark-purple
              rounded-l-full
              absolute
              h-80
              w-2/4
              -bottom-24
              -right-36
            "
          ></div>
        </div>
       
      </section> --}}
  
      <!-- Download -->
      {{-- <section class="py-20 mt-20">
        <!-- Heading -->
        <div class="sm:w-3/4 lg:w-5/12 mx-auto px-2">
          <h1 class="text-3xl text-center text-bookmark-blue">Download the extension</h1>
          <p class="text-center text-bookmark-grey mt-4">
            We’ve got more browsers in the pipeline. Please do let us know if you’ve got a favourite you’d like us to
            prioritize.
          </p>
        </div>
        <!-- Cards -->
        <div class="container grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-16 max-w-screen-lg mt-16">
          <!-- Card 1 -->
          <div class="flex flex-col rounded-md shadow-md lg:mb-16">
            <div class="p-6 flex flex-col items-center">
              <img src="{{asset('/img/logo-chrome.svg')}}" alt="" />
              <h3 class="mt-5 mb-2 text-bookmark-blue text-lg">Add to Chrome</h3>
              <p class="mb-2 text-bookmark-grey font-light">Minimum version 62</p>
            </div>
            <hr class="border-b border-bookmark-white" />
            <div class="flex p-6">
              <button type="button" class="flex-1 btn btn-purple hover:bg-bookmark-white hover:text-black">
                Add & Install Extension
              </button>
            </div>
          </div>
          <!-- Card 2 -->
          <div class="flex flex-col rounded-md shadow-md lg:my-8">
            <div class="p-6 flex flex-col items-center">
              <img src="{{asset('/img/logo-firefox.svg')}}" alt="" />
              <h3 class="mt-5 mb-2 text-bookmark-blue text-lg">Add to Firefox</h3>
              <p class="mb-2 text-bookmark-grey font-light">Minimum version 62</p>
            </div>
            <hr class="border-b border-bookmark-white" />
            <div class="flex p-6">
              <button type="button" class="flex-1 btn btn-purple hover:bg-bookmark-white hover:text-black">
                Add & Install Extension
              </button>
            </div>
          </div>
          <!-- Card 3 -->
          <div class="flex flex-col rounded-md shadow-md lg:mt-16">
            <div class="p-6 flex flex-col items-center">
              <img src="{{asset('/img/logo-opera.svg')}}" alt="" />
              <h3 class="mt-5 mb-2 text-bookmark-blue text-lg">Add to Opera</h3>
              <p class="mb-2 text-bookmark-grey font-light">Minimum version 62</p>
            </div>
            <hr class="border-b border-bookmark-white" />
            <div class="flex p-6">
              <button type="button" class="flex-1 btn btn-purple hover:bg-bookmark-white hover:text-black">
                Add & Install Extension
              </button>
            </div>
          </div>
        </div>
      </section> --}}
  
    
  
      <!-- Contact Us -->
      {{-- <section class="bg-bookmark-purple text-white py-20">
        <div class="container">
          <div class="sm:w-3/4 lg:w-2/4 mx-auto">
            <p class="font-light uppercase text-center mb-8">35,000+ ALREADY JOINED</p>
            <h1 class="text-3xl text-center">Stay up-to-date with what we’re doing</h1>
            <div class="flex flex-col sm:flex-row gap-6 mt-8">
              <input
                type="text"
                placeholder="Enter your email address"
                class="focus:outline-none flex-1 px-2 py-3 rounded-md text-black"
              />
              <button type="button" class="btn bg-bookmark-red hover:bg-bookmark-white hover:text-black">
                Contact Us
              </button>
            </div>
          </div>
        </div>
      </section> --}}
  
      

    {{-- </main> --}}

      <script>

        // const navbar = document.querySelector('header');

        // window.onscroll = () => {
        //   if (window.scrollY > 100) {
        //     navbar.classList.add('bg-gray-300');
        //     navbar.classList.add('border-b');
        //     navbar.classList.add('bg-color-gray');
            
        //   }else{
        //     navbar.classList.remove('bg-gray-300');
        //     navbar.classList.remove('border-b');
        //     navbar.classList.remove('bg-color-gray');
        //   }
        // }

        // Mobile menu
        const hamburger = document.querySelector('#hamburger');
        const menu = document.querySelector('#menu');
        const hLink = document.querySelector('#hLink');
        const faSolid = document.querySelector('.fa-solid');
        

        hamburger.addEventListener("click", ()=>{
          menu.classList.toggle('hidden');
          faSolid.classList.toggle('fa-bars')
          faSolid.classList.toggle('fa-xmark')
        })

        // hLink.forEach(element => {
        //   link.addEventListener('click', () => {
        //     menu.classList.toggle('hidden');
        //     faSolid.classList.toggle('fa-bars')
        //     faSolid.classList.toggle('fa-xmark')
        //   })
        // });
      </script>
    

</body>
</html>