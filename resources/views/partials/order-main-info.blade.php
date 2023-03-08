<div class="border d-flex justify-content-evenly w-100 layout-top-spacing py-2 bg-dark rounded comment-text-area-custom">
<ol class="breadcrumb ">
            <li class="breadcrumb-item">  <h5 class="text-white bg-birght rounded p-2">ZGŁOSZENIE NR {{$singleOrder->id}} # Firma: {{$company->name}}</h5>  </li>
            <li class="breadcrumb"><h6 class="ms-5 text-yellow bg-bright rounded p-2 "  >Tytuł:  "{{$singleOrder->title}}"</h6></li>
        </ol>
        <ol class="breadcrumb d-flex">
            
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
</div>