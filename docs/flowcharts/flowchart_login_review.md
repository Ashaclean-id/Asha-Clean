# Flowchart Alur User Login dan Memberi Review

```mermaid
graph TD
    A([Mulai]) --> B[/User Buka Website/]
    B --> C{Sudah Punya Akun?}
    
    C -->|Tidak| D[/User Melakukan Register/]
    D --> E[Simpan Akun Baru ke Database]
    E --> F
    
    C -->|Ya| F[/User Mengisi Form Login/]
    F --> G[/Masuk Dashboard User/]
    G --> H[/User Membuka Riwayat Pesanan/]
    H --> I{Status Pesanan Selesai?}
    
    I -->|Tidak| J[/User Hanya Lihat Detail Pesanan/]
    J --> K([Selesai])
    
    I -->|Ya| L[Tombol Review Aktif]
    L --> M[/User Input Rating dan Komentar/]
    M --> N[Simpan Ulasan ke Database]
    N --> O([Selesai])
```

## Keterangan Simbol

| Simbol | Bentuk | Fungsi |
|--------|--------|--------|
| `([...])` | Oval | Start/End |
| `[/... /]` | Jajar Genjang | Input/Output |
| `[...]` | Persegi Panjang | Proses Sistem |
| `{...}` | Belah Ketupat | Decision |

## Cara Render ke Gambar

1. Buka [Mermaid Live Editor](https://mermaid.live/)
2. Copy kode Mermaid di atas
3. Export sebagai PNG/SVG
