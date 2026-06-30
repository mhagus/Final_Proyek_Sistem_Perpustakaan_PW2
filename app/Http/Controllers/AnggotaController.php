<?php
 
namespace App\Http\Controllers;
 
use Illuminate\Http\Request;
use App\Models\Anggota;
use App\Http\Requests\StoreAnggotaRequest;
use App\Http\Requests\UpdateAnggotaRequest;
 
class AnggotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $anggotas = Anggota::latest()->get();
        
        // Statistik
        $totalAnggota = Anggota::count();
        $anggotaAktif = Anggota::where('status', 'Aktif')->count();
        $anggotaNonaktif = Anggota::where('status', 'Nonaktif')->count();
        
        return view('anggota.index', compact(
            'anggotas',
            'totalAnggota',
            'anggotaAktif',
            'anggotaNonaktif'
        ));
    }
 

    public function show(string $id)
    {
        $anggota = Anggota::findOrFail($id);
        return view('anggota.show', compact('anggota'));
    }
 
    
    // Helper function untuk generate kode anggota otomatis
    private function generateKodeAnggota()
    {
        $tahun = date('Y');
        
        // Cari anggota terakhir di tahun ini
        $lastAnggota = Anggota::whereYear('created_at', $tahun)
            ->orderBy('kode_anggota', 'desc')
            ->first();

        if ($lastAnggota) {
            // Ambil 3 digit terakhir dan tambah 1
            $lastNumber = intval(substr($lastAnggota->kode_anggota, -3));
            $newNumber = $lastNumber + 1;
        } else {
            // Jika belum ada data di tahun ini, mulai dari 1
            $newNumber = 1;
        }

        // Format: AGT-YYYY-001
        return 'AGT-' . $tahun . '-' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
    }

    // method create
    public function create()
    {
        $kodeAnggota = $this->generateKodeAnggota();
        return view('anggota.create', compact('kodeAnggota'));
    }

    public function store(StoreAnggotaRequest $request) 
    {
        try {
            // Create anggota baru dengan validated data
            Anggota::create($request->validated());
            
            // Redirect dengan success message
            return redirect()->route('anggota.index')
                            ->with('success', 'Anggota berhasil ditambahkan!');
                            
        } catch (\Exception $e) {
            // Redirect dengan error message jika gagal
            return redirect()->back()
                            ->withInput()
                            ->with('error', 'Gagal menambahkan anggota: ' . $e->getMessage());
        }
    }

    public function edit(string $id) 
    {
        $anggota = Anggota::findOrFail($id);
        return view('anggota.edit', compact('anggota'));
    }

    public function update(UpdateAnggotaRequest $request, string $id)
    {
        try {
            $anggota = Anggota::findOrFail($id);
            
            // Update anggota dengan validated data
            $anggota->update($request->validated());
            
            // Redirect dengan success message
            return redirect()->route('anggota.show', $anggota->id)
                            ->with('success', 'Data anggota berhasil diupdate!');
                            
        } catch (\Exception $e) {
            // Redirect dengan error message jika gagal
            return redirect()->back()
                            ->withInput()
                            ->with('error', 'Gagal mengupdate anggota: ' . $e->getMessage());
        }
    }

    public function destroy(string $id)
    {
        try {
            $anggota = Anggota::findOrFail($id);
            $namaAnggota = $anggota->nama;
            
            // Delete anggota
            $anggota->delete();
            
            // Redirect dengan success message
            return redirect()->route('anggota.index')
                            ->with('success', "Anggota '{$namaAnggota}' berhasil dihapus!");
                            
        } catch (\Exception $e) {
            // Redirect dengan error message jika gagal
            return redirect()->back()
                            ->with('error', 'Gagal menghapus anggota: ' . $e->getMessage());
        }
    }

    /**
     * Export anggota ke CSV (tanpa dependensi Maatwebsite).
     */
    public function export()
    {
        $anggotas = Anggota::all();

        $filename = 'anggota_' . date('Y-m-d_His') . '.csv';
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function() use ($anggotas) {
            $file = fopen('php://output', 'w');

            fputcsv($file, [
                'Kode', 'Nama', 'Email', 'Telepon', 'Alamat',
                'Tanggal Lahir', 'Jenis Kelamin', 'Pekerjaan', 'Status', 'Tanggal Daftar',
            ]);

            foreach ($anggotas as $anggota) {
                fputcsv($file, [
                    $anggota->kode_anggota,
                    $anggota->nama,
                    $anggota->email,
                    $anggota->telepon,
                    $anggota->alamat,
                    $anggota->tanggal_lahir ? $anggota->tanggal_lahir->format('Y-m-d') : '',
                    $anggota->jenis_kelamin,
                    $anggota->pekerjaan,
                    $anggota->status,
                    $anggota->tanggal_daftar ? $anggota->tanggal_daftar->format('Y-m-d') : '',
                ]);
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function search(Request $request)
    {
        $query = Anggota::query();

        if ($request->keyword) {
            $query->where(function($q) use ($request) {
                $q->where('nama', 'like', '%' . $request->keyword . '%')
                ->orWhere('email', 'like', '%' . $request->keyword . '%')
                ->orWhere('telepon', 'like', '%' . $request->keyword . '%');
            });
        }

        if ($request->jenis_kelamin) {
            $query->where('jenis_kelamin', $request->jenis_kelamin);
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        if ($request->pekerjaan) {
            $query->where('pekerjaan', $request->pekerjaan);
        }

        $anggotas = $query->latest()->get();

        // Statistics
        $totalAnggota = $anggotas->count();
        $anggotaAktif = $anggotas->where('status', 'Aktif')->count();
        $anggotaNonaktif = $anggotas->where('status', 'Nonaktif')->count();

        // Return kembali ke view index dengan data hasil filter
        return view('anggota.index', compact('anggotas', 'totalAnggota', 'anggotaAktif', 'anggotaNonaktif'));
    }
}