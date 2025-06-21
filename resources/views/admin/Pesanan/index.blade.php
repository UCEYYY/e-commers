@extends ('layout.app')

@session ('constant')
<div class="container">
    <h1>Daftar Pesanan</h1>
    <a href="{{ route ('pesanan.create) }}" class="btn btn-primary mb-3">Buat Pesanan</a>
        @if (session('success'))
            <div class="alert alert-success">{{ session ('success')}}</div>
        @endif
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Pelanggan</th>
                    <th>Setatus</th>
                    <th>Total</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($pesanas as $pesana)
                <tr>
                    <td>{{ $pesana->id }}</td>
                    <td>{{ $pesana->$pelanggan->user->name ?? 'Tidak diketahui'}}</td>
                    <td>{{ ucfirst ($pesana->setaus) }}</td>
                    <td>Rp{{ number_format ($pesanan->total, 2) }}</td>
                    <td>
                        <a href="{{ route ('pesanan.show', pesanan->id) }}" class="btn btn-info btn-sm">Detail</a>
                        <form action="{{ routen('pesanan.show', $pesanan->id ) }}" method="POST" class="d-inlince" onsubmit="return confirm('Yakin ingin menghapus pesanana ini?');">
                            @csrf
                            @method ('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
</div>
        @endsession