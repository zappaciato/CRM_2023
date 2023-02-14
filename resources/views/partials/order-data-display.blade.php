<div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-4">
    <div class="widget-content widget-content-area br-8 p-5">
        <div class="d-flex justify-content-center">
            <div class="info-box-3 col-md-6">
                <div class="info-box-3-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg>
                </div>
                <div class="info-box-3-content-wrapper hover-to-bright">
                    <h3 class="info-box-3-title">Podmioty powiązane:</h3>
                    <div class="">
                        <table>
                            <tr>
                                <th>Os. Odpowiedzialna</th>
                                <th>Os. zaangażowana</th>
                                <th>os. kontaktowa</th>
                            </tr>
                            <tr>
                                @foreach($users as $user)
                                    @if($singleOrder->lead_person == $user->id)
                                        <td><a class="text-black" href="{{route('single.user', $user->id)}}">{{$user->name}}</a></td>
                                        
                                    @endif
                                    @if($singleOrder->involved_person == $user->id)
                                    <td><a class="text-black" href="{{route('single.user', $user->id)}}">{{ $user->name }}</a></td>
                                        
                                    @endif
                                @endforeach
                                <td> <a class="text-black" href="{{ route('single.contact', $contactPerson->id) }}">{{$contactPerson->name}} {{$contactPerson->surname}}</a>    </td>
                            </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="info-box-3 col-md-6">
                <div class="info-box-3-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-watch"><circle cx="12" cy="12" r="7"></circle><polyline points="12 9 12 12 13.5 13.5"></polyline><path d="M16.51 17.35l-.35 3.83a2 2 0 0 1-2 1.82H9.83a2 2 0 0 1-2-1.82l-.35-3.83m.01-10.7l.35-3.83A2 2 0 0 1 9.83 1h4.35a2 2 0 0 1 2 1.82l.35 3.83"></path></svg>
                </div>
                <div class="info-box-3-content-wrapper ">
                    <h3 class="info-box-3-title">Terminy i statusy: </h3>
                    <table>
                            <tr>
                                <th>Data otrzymania: </th>
                                <th>Termin wykonania: </th>
                                <th>Aktualny status: </th>
                                <th>Typ zgłoszenia: </th>
                            </tr>
                            <tr>
                                <td>{{$singleOrder->created_at}}</td>
                                <td>{{$singleOrder->deadline }}</td>
                                <td>{{$singleOrder->status }}</td>
                                <td>rotacje</td>
                            </tr>
                    </table>
                </div>
            </div>
        </div>


        <div class="info-box-3 ">
            <div class="info-box-3-icon">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-clipboard"><path d="M16 4h2a2 2 0 0 1 2 2v14a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2V6a2 2 0 0 1 2-2h2"></path><rect x="8" y="2" width="8" height="4" rx="1" ry="1"></rect></svg>
            </div>
            <div class="info-box-3-content-wrapper">
                <h3 class="info-box-3-title">Treść zgłoszenia:</h3>
                <div class="info-box-3-content text-black  ms-5 px-5 "> <h5 class="hover-to-bright">{{$singleOrder->order_content}} </h5></div>
                <h4 class="info-box-3-title mt-5">Notatka wewnętrzna:</h4>
                <div class="info-box-3-content text-black  ms-5 px-5"> <h6 class="hover-to-bright">{{$singleOrder->order_notes}} </h6></div>
            </div>
        </div>



    </div>
</div>
