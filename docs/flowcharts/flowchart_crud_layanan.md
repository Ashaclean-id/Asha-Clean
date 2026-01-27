# Flowchart CRUD Manajemen Layanan oleh Admin

```mermaid
graph TD
    A([Mulai]) --> B[/Admin Buka Menu Services/]
    B --> C{Pilih Aksi?}
    
    C -->|Tambah| D[/Input Data Layanan Baru/]
    D --> E[Simpan ke Database]
    E --> J([Selesai])
    
    C -->|Edit| F[/Pilih Layanan/]
    F --> G[/Ubah Data/]
    G --> H[Update ke Database]
    H --> J
    
    C -->|Hapus| I[/Pilih Layanan/]
    I --> K[/Konfirmasi Hapus/]
    K --> L[Delete dari Database]
    L --> J
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
