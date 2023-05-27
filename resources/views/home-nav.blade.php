<!-----HOME----->
<a href="{{route('home')}}" 
    class="hover:text-red-500
    @if (request()->is('/'))
       underline text-brightRed
    @endif
    ">Home
</a>


<!-----Dashboard----->
<a href="{{route('dashboard')}}" 
    class="hover:text-red-500
    @if (request()->is('services'))
        underline text-brightRed
    @endif
    ">Dashboard
</a>

<!-----DOCUMENTATION----->
<a href="https://docs.google.com/document/d/18pwBAMoOW1aCxMs_5feR2jMpQBpjFItF/edit?usp=share_link&ouid=117350417796665892451&rtpof=true&sd=true" 
    class="hover:text-red-500
    @if (request()->is('documentation'))
        underline text-brightRed
    @endif
    "target="_blank">Documentation
</a>

<!-----Tutorial----->
<a href="{{route('tutorial')}}" 
    class="hover:text-red-500
    @if (request()->is('tutorial'))
        underline text-brightRed
    @endif
    ">Tutorial
</a>
