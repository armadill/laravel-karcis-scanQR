<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | The following language lines contain the default error messages used by
    | the validator class. Some of these rules have multiple versions such
    | as the size rules. Feel free to tweak each of these messages here.
    |
    */

    'accepted' => 'Isian :attribute harus diterima.',
    'active_url' => 'Isian :attribute bukan URL yang valid.',
    'after' => 'Isian :attribute harus tanggal setelah :date.',
    'after_or_equal' => 'Isian :attribute harus berupa tanggal setelah atau sama dengan tanggal :date.',
    'alpha' => 'Isian :attribute hanya boleh berisi huruf.',
    'alpha_dash' => 'Isian :attribute hanya boleh berisi huruf, angka, dan strip.',
    'alpha_num' => 'Isian :attribute hanya boleh berisi huruf dan angka.',
    'array' => 'Isian :attribute harus berupa sebuah array.',
    'before' => 'Isian :attribute harus tanggal sebelum :date.',
    'before_or_equal' => 'Isian :attribute harus berupa tanggal sebelum atau sama dengan tanggal :date.',
    'between' => [
        'numeric' => 'Isian :attribute harus antara :min dan :max.',
        'file' => 'Isian :attribute harus antara :min dan :max kilobytes.',
        'string' => 'Isian :attribute harus antara :min dan :max karakter.',
        'array' => 'Isian :attribute harus antara :min dan :max item.',
    ],
    'boolean' => 'Isian :attribute harus berupa true atau false',
    'confirmed' => 'Konfirmasi :attribute tidak cocok.',
    'date' => 'Isian :attribute bukan tanggal yang valid.',
    'date_equals' => 'The :attribute must be a date equal to :date.',
    'date_format' => 'Isian :attribute tidak cocok dengan format :format.',
    'different' => 'Isian :attribute dan :other harus berbeda.',
    'digits' => 'Isian :attribute harus berupa angka :digits.',
    'digits_between' => 'Isian :attribute harus antara angka :min dan :max.',
    'dimensions' => 'Bidang :attribute tidak memiliki dimensi gambar yang valid.',
    'distinct' => 'Bidang isian :attribute memiliki nilai yang duplikat.',
    'email' => 'Isian :attribute harus berupa alamat surel yang valid.',
    'ends_with' => 'The :attribute must end with one of the following: :values',
    'exists' => 'Isian :attribute yang dipilih tidak valid.',
    'file' => 'Bidang :attribute harus berupa sebuah berkas.',
    'filled' => 'Isian :attribute harus memiliki nilai.',
    'gt' => [
        'numeric' => 'The :attribute must be greater than :value.',
        'file' => 'The :attribute must be greater than :value kilobytes.',
        'string' => 'The :attribute must be greater than :value characters.',
        'array' => 'The :attribute must have more than :value items.',
    ],
    'gte' => [
        'numeric' => 'The :attribute must be greater than or equal :value.',
        'file' => 'The :attribute must be greater than or equal :value kilobytes.',
        'string' => 'The :attribute must be greater than or equal :value characters.',
        'array' => 'The :attribute must have :value items or more.',
    ],
    'image' => 'Isian :attribute harus berupa gambar.',
    'in' => 'Isian :attribute yang dipilih tidak valid.',
    'in_array' => 'Bidang isian :attribute tidak terdapat dalam :other.',
    'integer' => 'Isian :attribute harus merupakan bilangan bulat.',
    'ip' => 'Isian :attribute harus berupa alamat IP yang valid.',
    'ipv4' => 'Isian :attribute harus berupa alamat IPv4 yang valid.',
    'ipv6' => 'Isian :attribute harus berupa alamat IPv6 yang valid.',
    'json' => 'Isian :attribute harus berupa JSON string yang valid.',
    'lt' => [
        'numeric' => 'The :attribute must be less than :value.',
        'file' => 'The :attribute must be less than :value kilobytes.',
        'string' => 'The :attribute must be less than :value characters.',
        'array' => 'The :attribute must have less than :value items.',
    ],
    'lte' => [
        'numeric' => 'The :attribute must be less than or equal :value.',
        'file' => 'The :attribute must be less than or equal :value kilobytes.',
        'string' => 'The :attribute must be less than or equal :value characters.',
        'array' => 'The :attribute must not have more than :value items.',
    ],
    'max' => [
        'numeric' => 'Isian :attribute seharusnya tidak lebih dari :max.',
        'file' => 'Isian :attribute seharusnya tidak lebih dari :max kilobytes.',
        'string' => 'Isian :attribute seharusnya tidak lebih dari :max karakter.',
        'array' => 'Isian :attribute seharusnya tidak lebih dari :max item.',
    ],
    'mimes' => 'Isian :attribute harus dokumen berjenis : :values.',
    'mimetypes' => 'Isian :attribute harus dokumen berjenis : :values.',
    'min' => [
        'numeric' => 'Isian :attribute harus minimal :min.',
        'file' => 'Isian :attribute harus minimal :min kilobytes.',
        'string' => 'Isian :attribute harus minimal :min karakter.',
        'array' => 'Isian :attribute harus minimal :min item.',
    ],
    'not_in' => 'Isian :attribute yang dipilih tidak valid.',
    'not_regex' => 'The :attribute format is invalid.',
    'numeric' => 'Isian :attribute harus berupa angka.',
    'present' => 'Bidang isian :attribute wajib ada.',
    'regex' => 'Format isian :attribute tidak valid.',
    'required' => 'Bidang isian :attribute wajib diisi.',
    'required_if' => 'Bidang isian :attribute wajib diisi bila :other adalah :value.',
    'required_unless' => 'Bidang isian :attribute wajib diisi kecuali :other memiliki nilai :values.',
    'required_with' => 'Bidang isian :attribute wajib diisi bila terdapat :values.',
    'required_with_all' => 'Bidang isian :attribute wajib diisi bila terdapat :values.',
    'required_without' => 'Bidang isian :attribute wajib diisi bila tidak terdapat :values.',
    'required_without_all' => 'Bidang isian :attribute wajib diisi bila tidak terdapat ada :values.',
    'same' => 'Isian :attribute dan :other harus sama.',
    'size' => [
        'numeric' => 'Isian :attribute harus berukuran :size.',
        'file' => 'Isian :attribute harus berukuran :size kilobyte.',
        'string' => 'Isian :attribute harus berukuran :size karakter.',
        'array' => 'Isian :attribute harus mengandung :size item.',
    ],
    'starts_with' => 'The :attribute must start with one of the following: :values',
    'string' => 'Isian :attribute harus berupa string.',
    'timezone' => 'Isian :attribute harus berupa zona waktu yang valid.',
    'unique' => 'Isian :attribute sudah ada yang menggunakan.',
    'uploaded' => 'Isian :attribute gagal diunggah.',
    'url' => 'Format isian :attribute tidak valid.',
    'uuid' => 'The :attribute must be a valid UUID.',

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Language Lines
    |--------------------------------------------------------------------------
    |
    | Here you may specify custom validation messages for attributes using the
    | convention "attribute.rule" to name the lines. This makes it quick to
    | specify a specific custom language line for a given attribute rule.
    |
    */

    'custom' => [
        'attribute-name' => [
            'rule-name' => 'custom-message',
        ],
        // 'txtkegiatan' => [
        //     'required' => 'Bidang kolom kegiatan wajib diisi.',
        // ]
    ],

    /*
    |--------------------------------------------------------------------------
    | Custom Validation Attributes
    |--------------------------------------------------------------------------
    |
    | The following language lines are used to swap our attribute placeholder
    | with something more reader friendly such as "E-Mail Address" instead
    | of "email". This simply helps us make our message more expressive.
    |
    */

    'attributes' => [
        'nama' => 'Nama',
        'isi' => 'Isi',
        'jabatan' => 'Jabatan',
        'txtnope' => 'Nomor Telpon',
        'judul' => 'Judul',
        'alamat' => 'Alamat',
        'ket' => 'Ket',
        'file' => 'Foto',
        'profesi' => 'Profesi',
        'keluhan' => 'Keluhan',
        'txtnama' => 'Nama',
        'txtemail' => 'Email',
        'txtrole' => 'Status Hak Akses',
        'txtpass' => 'Password',
        'askhamil' => 'Pertanyaan Kehamilan',
        'passold' => 'Password lama',
        'passnew' => 'Password baru',
        'passnew1' => 'Password Konfirmasi',

    ],

];
