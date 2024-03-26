<!-- resources/views/rt.blade.php -->

<h1>Daftar RT Penduduk</h1>
<ul>
    @foreach($rt as $rtItem)
        <li>{{ $rtItem->nama_rt }}</li>
    @endforeach
</ul>
