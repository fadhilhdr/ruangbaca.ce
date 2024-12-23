<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Profile Information') }}
        </h2>
    </header>

    <!-- Profile Information (Read-Only) -->
    <div class="mt-6 space-y-6 bg-white p-6 rounded-lg">
        <!-- User ID -->
        <div>
            <x-input-label for="userid" :value="__('User ID')" />
            <x-text-input id="userid" name="userid" type="text" class="mt-1 block w-full bg-gray-100" :value="$user->userid" disabled />
        </div>

        <!-- Name -->
        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full bg-gray-100" :value="$user->name" disabled />
        </div>

        <!-- Additional Information (Read-Only Fields) -->
        @if ($user->student)
            <div>
                <x-input-label for="angkatan" :value="__('Angkatan')" />
                <x-text-input id="angkatan" name="angkatan" type="text" class="mt-1 block w-full bg-gray-100" :value="$user->student->angkatan" disabled />
            </div>
            <div>
                <x-input-label for="gender" :value="__('Gender')" />
                <x-text-input id="gender" name="gender" type="text" class="mt-1 block w-full bg-gray-100" :value="$user->student->gender" disabled />
            </div>
            <div>
                <x-input-label for="status" :value="__('Status')" />
                <x-text-input id="status" name="status" type="text" class="mt-1 block w-full bg-gray-100" :value="$user->student->status" disabled />
            </div>
        @elseif ($user->lecturer)
            <div>
                <x-input-label for="kode_dosen" :value="__('Kode Dosen')" />
                <x-text-input id="kode_dosen" name="kode_dosen" type="text" class="mt-1 block w-full bg-gray-100" :value="$user->lecturer->kode_dosen" disabled />
            </div>
            <div>
                <x-input-label for="riwayat_s1" :value="__('Riwayat S1')" />
                <x-text-input id="riwayat_s1" name="riwayat_s1" type="text" class="mt-1 block w-full bg-gray-100" :value="$user->lecturer->riwayat_s1" disabled />
            </div>
            <div>
                <x-input-label for="riwayat_s2" :value="__('Riwayat S2')" />
                <x-text-input id="riwayat_s2" name="riwayat_s2" type="text" class="mt-1 block w-full bg-gray-100" :value="$user->lecturer->riwayat_s2" disabled />
            </div>
            <div>
                <x-input-label for="riwayat_s3" :value="__('Riwayat S3')" />
                <x-text-input id="riwayat_s3" name="riwayat_s3" type="text" class="mt-1 block w-full bg-gray-100" :value="$user->lecturer->riwayat_s3 ?? __('Not available')" disabled />
            </div>
            <div>
                <x-input-label for="kepakaran1" :value="__('Kepakaran 1')" />
                <x-text-input id="kepakaran1" name="kepakaran1" type="text" class="mt-1 block w-full bg-gray-100" :value="$user->lecturer->kepakaran1" disabled />
            </div>
            <div>
                <x-input-label for="kepakaran2" :value="__('Kepakaran 2')" />
                <x-text-input id="kepakaran2" name="kepakaran2" type="text" class="mt-1 block w-full bg-gray-100" :value="$user->lecturer->kepakaran2 ?? __('Not available')" disabled />
            </div>
        @elseif ($user->employee)
            <div>
                <x-input-label for="division" :value="__('Division')" />
                <x-text-input id="division" name="division" type="text" class="mt-1 block w-full bg-gray-100" :value="$user->employee->division" disabled />
            </div>
        @endif

        <!-- Role -->
        <div>
            <x-input-label for="role" :value="__('Role')" />
            <x-text-input id="role" name="role" type="text" class="mt-1 block w-full bg-gray-100" :value="$user->role->name ?? __('Not available')" disabled />
        </div>
    </div>
</section>
