<ol class="breadcrumb layout-top-spacing">
            <li class="breadcrumb-item"><a href="#">  <h4 class="text-black bg-secondary rounded p-2 px-5">ZGŁOSZENIE NR {{$singleOrder->id}} # Firma: {{$company->name}}</h4> <h5 class="ms-5 text-black bg-warning rounded p-3 px-5"  >Tytuł:  "{{$singleOrder->title}}"</h5> </a></li>
        </ol>
        <ol class="breadcrumb layout-top-spacing">
            
            @switch($singleOrder->status)
                @case('closed')
                    <li class="breadcrumb-item ms-5"><a href="#">  <h4 class="text-black bg-danger rounded p-2 px-5 ms-5">STATUS: "{{$singleOrder->status}}"
                    @break
                @case('new')
                    <li class="breadcrumb-item ms-5"><a href="#">  <h4 class="text-black bg-warning rounded p-2 px-5 ms-5">STATUS: "{{$singleOrder->status}}"
                    @break
                @case('open')
                    <li class="breadcrumb-item ms-5"><a href="#">  <h4 class="text-black bg-success rounded p-2 px-5 ms-5">STATUS: "{{$singleOrder->status}}"
                    @break
            
                @default
                    <li class="breadcrumb-item ms-5"><a href="#">  <h4 class="text-black bg-primary rounded p-2 px-5 ms-5">STATUS: "{{$singleOrder->status}}"
            @endswitch
             
        </ol>