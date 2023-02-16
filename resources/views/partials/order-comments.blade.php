{{-- order comments forum like START --}}
        <div class="col-xxl-12 col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-4">
            <div class="post-info">
                <h2 class="mb-2">Komentarze <span class="comment-count text-danger">{{count($comments)}}</span></h2>
                <hr>
                    <div class="post-comments d-flex justify-content-center align-items-center flex-column">
                        @foreach($comments as $comment)
                        @foreach($users as $user)
                        @if($comment->user_id === $user->id)
                        <div class="media mb-2 pb-5 primary-comment w-50 ">
                            <div class="avatar me-4">
                                <img alt="avatar" src='{{$user->getFirstMedia('avatars') ? $user->getFirstMedia('avatars')->getUrl() : "#"}}' class="rounded-circle" />
                            </div>
                            <div class="media-body border-bottom border-danger p-2" style="margin-bottom: -20px">
                                {{-- tutaj cos jest nie tak... tylko admin widzi tak jak trzeba, pozostali users nie..wszedzie jest ten sam user ktory komentuje PRZEtESTOWAAC TO JESZCE TODO--}}
                                
                                <h5 class="media-heading mb-1">{{$user->name }}</h5>
                                @endif
                                @endforeach
                                
                                <div class="meta-info mb-0">{{$comment->created_at}}</div>
                                <p class="media-text mt-2 mb-0">{{$comment->content}} </p>
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