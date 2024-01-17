<x-app-layout>

    <br>
    <a href="{{ route('payments.index-transaction') }}" class="text-reset" style="margin-left: 20%">
        <i class="mdi mdi-arrow-left"></i>
        Back
    </a>

    {{-- Transaction Section --}}
    <div class="card mt-2" style="margin-left: 20%; margin-right: 20%">
        <div class="card-body px-4 py-3">

            <div class="row">

                <div class="col-10">
                    <h2 style="font-size: 20px">Transaction #{{ $transaction->id }}</h2>
                </div>

                <div class="d-flex align-items-center">

                    @switch($transaction->status)
                        @case('Paid')
                            <svg xmlns="http://www.w3.org/2000/svg" height="8" width="8" viewBox="0 0 512 512">
                                <path fill="#00ff40" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z" />
                            </svg>
                        @break

                        @case('Unpaid')
                            <svg xmlns="http://www.w3.org/2000/svg" height="8" width="8" viewBox="0 0 512 512">
                                <path fill="#ff0000" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z" />
                            </svg>
                        @break

                        @default
                            <svg xmlns="http://www.w3.org/2000/svg" height="8" width="8" viewBox="0 0 512 512">
                                <path fill="#FFA500" d="M256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512z" />
                            </svg>
                    @endswitch

                    <span style="font-size: 18px; margin-left: 10px"><b>{{ $transaction->status }}</b></span>

                </div>

            </div>

            <p class="mb-3"><b>{{ optional($transaction->created_at)->format('d F Y, H:i') }}</b></p>

            <div class="row">

                <div class="col-4">
                    <label for="name">Kiosk Name</label>
                    <p class="text-black">{{ $transaction->user->kioskParticipant->kiosk->name }}</p>
                </div>

                <div class="col-1" style="border-left:1px solid #d6d6d6;height:50px"></div>

                <div class="col-4">
                    <label for="name">Amount (RM)</label>
                    <p class="text-black">{{ $transaction->amount }}</p>
                </div>

            </div>

        </div>
    </div>

    {{-- Summary Section --}}
    <div class="card mt-2" style="margin-left: 20%; margin-right: 20%; height:500px">
        <div class="card-body px-4 py-3">

            <h2 class="mb-4" style="font-size: 20px">Summary</h2>

            <div class="row mb-1">

                <div class="col">
                    <label for="name"><b>Name</b></label>
                    <p>{{ $transaction->user->name }}</p>
                </div>

                <div class="col">
                    <label for="kiosk"><b>Kiosk Number</b></label>
                    <p>FKK01</p>
                </div>

            </div>

            <div class="row mb-1">

                <div class="col">
                    <label for="name"><b>Course</b></label>
                    <p>Software Engineering</p>
                </div>

                <div class="col">
                    <label for="kiosk"><b>Business Type</b></label>
                    <p>Clothes</p>
                </div>

            </div>

            <div class="row mb-1">

                <div class="col">
                    <label for="name"><b>Year / Semester</b></label>
                    <p>Year 4</p>
                </div>

                <div class="col">
                    <label for="kiosk"><b>Business Period</b></label>
                    <p>3 Jan 2024 - 3 Dec 2024</p>
                </div>

            </div>

            <div class="row mb-1">

                <div class="col">
                    <label for="name"><b>Contact No</b></label>
                    <p>{{ $transaction->user->mobile_no }}</p>
                </div>

            </div>

        </div>
    </div>

</x-app-layout>
