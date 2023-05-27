<style>
    /* Set a max-width for the main content area */
.max-w-7xl {
  max-width: 1000px;
  margin: 0 auto;
}

/* Add a margin to the bottom of each section */
.mb-8 {
  margin-bottom: 2rem;
}

/* Style the headings */
.text-2xl {
  font-size: 1.5rem;
  font-weight: 600;
  line-height: 2rem;
  margin-bottom: 1rem;
}

/* Style the paragraphs */
p {
  font-size: 1.125rem;
  line-height: 1.75rem;
  margin-bottom: 1rem;
}

/* Style the unordered list */
ul {
  list-style: disc;
  margin-left: 1.5rem;
}

/* Style the embedded video */
.aspect-w-16 {
  position: relative;
  display: block;
  width: 100%;
  height: 0;
  padding-bottom: 56.25%;
}

.aspect-h-9 {
  padding-bottom: 44.44%;
}

iframe {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
}

/* Style the page header */
.font-semibold {
  font-weight: 600;
}

.text-xl {
  font-size: 1.25rem;
  line-height: 1.75rem;
}

/* Set a max-width for images */
img {
  max-width: 100%;
}
.logo-container {
  display: flex;
  align-items: center;
}

.logo-container a {
  margin-right: 10px;
}

.logo-container img {
  height: 40px;
}

.page-title {
  font-size: 28px;
  font-weight: bold;
  color: #333;
}


</style>
<x-app-layout>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <x-slot name="header">
      <header class="flex items-center">
          <div class="flex items-center">
              <a href="{{ route('home') }}">
                  <x-jet-application-mark class="block h-9 w-auto" />
              </a>
              <h2 class="ml-2 font-semibold text-xl text-gray-800 leading-tight">{{ __('Tutorial') }}</h2>
          </div>
      </header>
  </x-slot>
  
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    
            <div class="mb-8">
                <h3 class="text-2xl font-medium mb-2">Introduction</h3>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nulla nec orci eget diam scelerisque consectetur sit amet quis ante.</p>
            </div>
    
            <div class="mb-8">
                <h3 class="text-2xl font-medium mb-2">Methodology</h3>
                <p>Donec rutrum felis ac metus tristique, ac accumsan dolor consectetur. Suspendisse nec enim eu augue semper aliquet sed ut nunc.</p>
            </div>
    
            <div class="mb-8">
                <h3 class="text-2xl font-medium mb-2">Results</h3>
                <p>Vivamus commodo tellus a ligula iaculis convallis. Nam ac nisi at est volutpat commodo eu ut urna.</p>
            </div>
    
            <div class="mb-8">
                <div class="aspect-w-16 aspect-h-9">
               <!-- Replace "RbMx2iczLKk" with the video ID of your YouTube video -->
                <iframe width="100%" height="500" src="https://www.youtube.com/embed/MVPTGNGiI-4" 
                frameborder="0" allowfullscreen></iframe>

                </div>
            </div>
    
            <div class="mb-8">
                <h3 class="text-2xl font-medium mb-2">Tools and Services</h3>
                <p>Mauris dapibus, augue eu scelerisque faucibus, velit velit imperdiet nibh, at ullamcorper nulla libero a arcu. Sed tristique enim vitae lectus elementum euismod.</p>
                <p>About the Predictive Model:</p>
                <ul>
                    <li>Lorem ipsum dolor sit amet</li>
                    <li>Consectetur adipiscing elit</li>
                    <li>Etiam tincidunt enim nec lectus efficitur consequat</li>
                </ul>
            </div>
    
        </div>
    </div>

</x-app-layout>