<form action="{{ route('export.location') }}" method="post">
    @csrf
    @method('post')
    <button class="bg-darkBlue p-3 text-xs rounded text-white hover:bg-darkGrayishBlue hover:text-darkBlue">Download</button>
</form>