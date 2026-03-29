<section class="blog-details">
    <div class="header-space"></div>
    <div class="container">
        <div class="row">
        <!-- Service Navigation List -->
        <div class="col-lg-4 col-md-5 pe-md-5">
            <div class="sidebar">
                @include('frontend.client.sidebar')
                @include('frontend.client.banner')
            </div>
        </div>
        <div class="col-lg-8 col-md-7 mt-5 mt-md-0">
            <div class="card p-4 border-0  shadow-sm">
                <h5 class="mb-4">Notices</h5>
                <table class="table border-0">
                    <tbody>
                        @foreach($notices as $item)
                            <tr class="border">
                                <td class="border-0 text-muted text-start">{{ \Carbon\Carbon::parse($item->created_at)->format('M d,Y - h:i A') }}</td>
                                <td class="border-0">{!! \Illuminate\Support\Str::words($item->title, 10, ' <a href="'.route('notices.view',$item->id).'" target="_blank" class="text-primary">...more</a>') !!}</td>
                                <td class="border-0">
                                     @if ($item->file)
                                        <a href="{{asset($item->file)}}" target="_blank" class="badge bg-primary px-2">File</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        </div>
    </div>
</section>