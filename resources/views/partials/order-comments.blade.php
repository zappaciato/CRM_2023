{{-- order comments forum like START --}}
        <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-4">
            <div class="post-info">
                    <div class="rte">
                        <h2>{{count($comments) > 0 ? count($comments)  . '' .' Comments' : 'Zostaw swój pierwszy komentarz.'}} </h2>

                    </div>
                    <hr>

                    {{-- <div class="post-tags mt-5">

                        <span class="badge badge-primary mb-2">Admin</span>
                        <span class="badge badge-primary mb-2">Themeforeset</span>
                        <span class="badge badge-primary mb-2">Dashboard</span>
                        <span class="badge badge-primary mb-2">Top 10</span>
                        
                    </div> --}}

                    {{-- <div class="post-dynamic-meta mt-5 mb-5">

                        <button class="btn btn-secondary me-4 mb-2">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg>
                            <span class="btn-text-inner">1.1k</span>
                        </button>
                        
                        <div class="avatar--group mb-2">
                            <div class="avatar avatar-sm m-0">
                                <img alt="avatar" src="{{Vite::asset('resources/images/profile-16.jpeg')}}" class="rounded-circle">
                            </div>
                            <div class="avatar avatar-sm">
                                <img alt="avatar" src="{{Vite::asset('resources/images/delete-user-4.jpeg')}}" class="rounded-circle">
                            </div>
                            <div class="avatar avatar-sm">
                                <img alt="avatar" src="{{Vite::asset('resources/images/profile-5.jpeg')}}" class="rounded-circle">
                            </div>
                            <div class="avatar avatar-sm">
                                <span class="avatar-title rounded-circle">AG</span>
                            </div>
                        </div>
                    </div> --}}
                    
                    <hr>

                    <h2 class="mb-2">Comments <span class="comment-count">{{count($comments)}}</span></h2>

                    <div class="post-comments d-flex justify-content-center align-items-center flex-column">
                        @foreach($comments as $comment)
                        <div class="media mb-2 pb-5 primary-comment w-50 ">
                            <div class="avatar me-4">
                                <img alt="avatar" src="{{Vite::asset('resources/images/profile-2.jpeg')}}" class="rounded-circle" />
                            </div>
                            <div class="media-body" style="margin-bottom: -20px">
                                
                                @foreach($users as $user)
                                @if($comment->user_id === $user->id)
                                <h5 class="media-heading mb-1">{{$user->name }}</h5>
                                @endif
                                @endforeach
                                
                                <div class="meta-info mb-0">{{$comment->created_at}}</div>
                                <p class="media-text mt-2 mb-0">{{$comment->content}}</p>

                                {{-- <button class="btn btn-success btn-icon btn-reply btn-rounded">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg>
                                </button> --}}
                                
                                {{-- <div class="media mb-4 mt-4">
                                    <div class="avatar me-4">
                                        <img alt="avatar" src="{{Vite::asset('resources/images/profile-3.jpeg')}}" class="rounded-circle" />
                                    </div>
                                    <div class="media-body">
                                        <h5 class="media-heading mb-1">Xavier</h5>
                                        <div class="meta-info mb-0">15 April</div>
                                        <p class="media-text mt-2 mb-0">Fusce condimentum cursus mauris et ornare. Mauris fermentum mi id sollicitudin viverra. Aenean dignissim sed ante eget dapibus. Sed dapibus nulla elementum, rutrum neque eu, gravida neque.</p>
                                    </div>
                                </div> --}}

                                {{-- <div class="media mt-4">
                                    <div class="avatar me-4">
                                        <img alt="avatar" src="{{Vite::asset('resources/images/profile-25.jpeg')}}" class="rounded-circle" />
                                    </div>
                                    <div class="media-body">
                                        <h5 class="media-heading mb-1">Mary McDonald</h5>
                                        <div class="meta-info mb-0">15 April</div>
                                        <p class="media-text mt-2 mb-0">Fusce condimentum cursus mauris et ornare. Mauris fermentum mi id sollicitudin viverra. Aenean dignissim sed ante eget dapibus. Sed dapibus nulla elementum, rutrum neque eu, gravida neque.</p>
                                    </div>
                                </div> --}}
                            </div>
                        </div>
                        @endforeach


                        <div class="post-pagination">

                            <div class="pagination-no_spacing">

                                <ul class="pagination">
                                    <li><a href="javascript:void(0);" class="prev"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-left"><polyline points="15 18 9 12 15 6"></polyline></svg></a></li>
                                    <li><a href="javascript:void(0);">1</a></li>
                                    <li><a href="javascript:void(0);" class="active">2</a></li>
                                    <li><a href="javascript:void(0);">3</a></li>
                                    <li><a href="javascript:void(0);" class="next"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-chevron-right"><polyline points="9 18 15 12 9 6"></polyline></svg></a></li>
                                </ul>

                            </div>
                            
                        </div>
                        

                    </div>
                    {{-- comments form --}}
                    <div class="post-form mt-5">

                        <div class="section add-comment">
                            <div class="info">
                                <h6>Dodaj swój <span class="text-success">komentarz</span> do tego zgłoszenia.</h6>
                                

                                <div class="row mt-4">

                                        <div class="col-md-12">
                                        <div class="mb-3">
                                            <form method="POST" action="{{route('order.comment.add')}}">
                                                @csrf

                                                <input type="hidden" name="order_id" value="{{$singleOrder->id}}">
                                                
                                                <label class="form-label">Napisz komentarz</label>
                                                <textarea name="content" class="form-control" cols="30" rows="10"></textarea>
                                            
                                        </div>
                                    </div>

                                </div>

                                <div class="text-end mt-4">
                                    <button type='submit'  class="btn btn-success">Dodaj</button>
                                </div>

                                </form>
                            </div>
                        </div>

                        
                    </div>
                    {{-- {end comments form} --}}
                </div>
            </div>
        </div>
{{-- Order comments END --}}