@extends('includes/main')
@section('content')
   <div class="row" id="app">
      <div class="col-lg-8 row m-0 p-0">
         <div class="col-sm-12">
            <div id="post-modal-data" class="card card-block">
               <div class="card-header d-flex justify-content-between">
                  <div class="header-title">
                     <h4 class="card-title">Create Post</h4>
                  </div>
               </div>
               <div class="card-body">
                  <div class="d-flex align-items-center">
                     <div class="user-img">
                        <img src="{{Auth::user()->image}}" alt="userimg" class="avatar-60 rounded-circle">
                     </div>
                     <form class="post-text ms-3 w-100 " data-bs-toggle="modal" data-bs-target="#post-modal" action="javascript:void();">
                        <input type="text" class="form-control rounded" placeholder="Write something here..." style="border:none;">
                     </form>
                  </div>
                  <hr>
                  <ul class=" post-opt-block d-flex list-inline m-0 p-0 flex-wrap">
                     <li class="me-3 mb-md-0 mb-2">
                        <a href="#" class="btn btn-soft-primary" data-bs-toggle="modal" data-bs-target="#post-modal">
                           <img src="../assets/images/small/07.png" alt="icon" class="img-fluid me-2"> Photo/Video
                        </a>
                     </li>
                     <li class="me-3 mb-md-0 mb-2">
                        <a href="#" class="btn btn-soft-primary" data-bs-toggle="modal" data-bs-target="#post-modal">
                           <img src="../assets/images/small/08.png" alt="icon" class="img-fluid me-2"> Tag Friend
                        </a>
                     </li>
                     <li class="me-3">
                        <a href="#" class="btn btn-soft-primary" data-bs-toggle="modal" data-bs-target="#post-modal">
                           <img src="../assets/images/small/09.png" alt="icon" class="img-fluid me-2"> Feeling/Activity
                        </a>
                     </li>
                     <li>
                        <button class="btn btn-soft-primary">
                           <div class="card-header-toolbar d-flex align-items-center">
                              <div class="dropdown">
                                 <div class="dropdown-toggle" id="post-option"   data-bs-toggle="dropdown">
                                    <i class="ri-more-fill"></i>
                                 </div>
                                 <div class="dropdown-menu dropdown-menu-right" aria-labelledby="post-option" style="">
                                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#post-modal">Check in</a>
                                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#post-modal">Live Video</a>
                                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#post-modal">Gif</a>
                                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#post-modal">Watch Party</a>
                                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#post-modal">Play with Friend</a>
                                 </div>
                              </div>
                           </div>
                        </button>
                     </li>
                  </ul>
               </div>
               <div class="modal fade" id="post-modal" tabindex="-1"  aria-labelledby="post-modalLabel" aria-hidden="true" >
                  <div class="modal-dialog   modal-fullscreen-sm-down">
                     <div class="modal-content">
                        <div class="modal-header">
                           <h5 class="modal-title" id="post-modalLabel">Create Post</h5>
                           <button type="button" class="btn btn-secondary" data-bs-dismiss="modal"><i class="ri-close-fill"></i></button>
                        </div>
                        <div class="modal-body">
                           <form class="post-text ms-3 w-100" @submit.prevent="createPost()" id="postForm" novalidate>
                              <div class="d-flex align-items-center justify-content-between">
                                 <div class="d-flex align-items-center">
                                    <div class="user-img">
                                       <img src="{{Auth::user()->image}}" alt="userimg" class="avatar-60 rounded-circle img-fluid">
                                    </div>
                                    <div>
                                       <input type="text" class="form-control rounded" v-model="postForm.text" placeholder="Write something here..." style="border:none;" required>
                                    </div>
                                 </div>
                                 <div v-if="selectedImage != ''" class="me-3" style="postion:relative;">
                                    <i class="fas fa-times-circle text-danger" aria-hidden="true" style="position:absolute;top:15px;right:15px;cursor:pointer;" @click="removeImage()"></i>
                                    <img :src="selectedImage" width="100" height="100">
                                 </div>
                              </div>
                              <hr>
                              <ul class="d-flex flex-wrap align-items-center list-inline m-0 p-0">
                                 <li class="col-md-6 mb-3">
                                    <div class="bg-soft-primary rounded p-2 pointer me-3" onclick="$('#postImage').click();"><a href="#"></a><img src="../assets/images/small/07.png" alt="icon" class="img-fluid"> Photo/Video</div>
                                    <input type="file" accept=".png, .jpg, .jpeg" style="display:none;" @change="postImageChange()" id="postImage">
                                 </li>
                                 <li class="col-md-6 mb-3">
                                    <div class="bg-soft-primary rounded p-2 pointer me-3"><a href="#"></a><img src="../assets/images/small/08.png" alt="icon" class="img-fluid"> Tag Friend</div>
                                 </li>
                                 <li class="col-md-6 mb-3">
                                    <div class="bg-soft-primary rounded p-2 pointer me-3"><a href="#"></a><img src="../assets/images/small/09.png" alt="icon" class="img-fluid"> Feeling/Activity</div>
                                 </li>
                                 <li class="col-md-6 mb-3">
                                    <div class="bg-soft-primary rounded p-2 pointer me-3"><a href="#"></a><img src="../assets/images/small/10.png" alt="icon" class="img-fluid"> Check in</div>
                                 </li>
                                 <li class="col-md-6 mb-3">
                                    <div class="bg-soft-primary rounded p-2 pointer me-3"><a href="#"></a><img src="../assets/images/small/11.png" alt="icon" class="img-fluid"> Live Video</div>
                                 </li>
                                 <li class="col-md-6 mb-3">
                                    <div class="bg-soft-primary rounded p-2 pointer me-3"><a href="#"></a><img src="../assets/images/small/12.png" alt="icon" class="img-fluid"> Gif</div>
                                 </li>
                                 <li class="col-md-6 mb-3">
                                    <div class="bg-soft-primary rounded p-2 pointer me-3"><a href="#"></a><img src="../assets/images/small/13.png" alt="icon" class="img-fluid"> Watch Party</div>
                                 </li>
                                 <li class="col-md-6 mb-3">
                                    <div class="bg-soft-primary rounded p-2 pointer me-3"><a href="#"></a><img src="../assets/images/small/14.png" alt="icon" class="img-fluid"> Play with Friends</div>
                                 </li>
                              </ul>
                              <button type="submit" class="btn btn-primary d-block w-100 mt-3 mx-auto">Post</button>
                           </form>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="col-sm-12" v-for="post in posts">
            <div class="card card-block">
               <div class="card-body">
                  <div class="user-post-data">
                     <div class="d-flex justify-content-between">
                        <div class="me-3">
                           <img class="avatar-60 rounded-circle img-fluid" :src="post.user.image">
                        </div>
                        <div class="w-100">
                           <div class="d-flex justify-content-between">
                              <div class="">
                                 <h5 class="mb-0 d-inline-block">@{{post.user.name}}</h5>
                                 <p class="mb-0 text-primary">@{{post.created_date}} - @{{post.created_time}}</p>
                              </div>
                              <div class="card-post-toolbar">
                                 <div class="dropdown">
                                    <span class="dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button" v-if="post.user.id == {{Auth::user()->id}}">
                                    <i class="ri-more-fill"></i>
                                    </span>
                                    <div class="dropdown-menu m-0 p-0">
                                       <a class="dropdown-item p-3" href="javascript:void(0)" @click="deletePost(post.id)">
                                          <div class="d-flex align-items-top">
                                             <i class="ri-close-circle-line h4"></i>
                                             <div class="data ms-2">
                                                <h6>Delete Post</h6>
                                                <p class="mb-0">Delete your post.</p>
                                             </div>
                                          </div>
                                       </a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="mt-3">
                     <p>@{{post.text}}</p>
                  </div>
                  <div class="user-post" v-if="post.image != null">
                     <img :src="post.image" alt="post-image" class="img-fluid rounded w-100">
                  </div>
                  <div class="comment-area mt-3">
                     <div class="d-flex justify-content-between align-items-center flex-wrap">
                        <div class="like-block position-relative d-flex align-items-center">
                           <div class="d-flex align-items-center">
                              <div class="like-data">
                                 <div class="dropdown">
                                    <span class="dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button" @click="likePost(post)" v-if="post.user.id != {{Auth::user()->id}}">
                                       <img src="../assets/images/icon/01.png" class="img-fluid" alt="">
                                    </span>
                                 </div>
                              </div>
                              <div class="total-like-block ms-2 me-3">
                                 <div class="dropdown">
                                    <span :class="{'text-primary': post.is_liked}" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">
                                    @{{post.likes.length}} Likes
                                    </span>
                                    <div class="dropdown-menu" v-if="post.likes.length > 0">
                                       <a v-for="like in post.likes" class="dropdown-item" href="javascript:void(0);">@{{like.user.name}}</a>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="total-comment-block">
                              <div class="dropdown">
                                 <span class="dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="button">
                                 @{{post.comments.length}} Comment
                                 </span>
                              </div>
                           </div>
                        </div>
                        <div class="share-block d-flex align-items-center feather-icon mt-2 mt-md-0">
                           <a href="javascript:void();" data-bs-toggle="offcanvas" data-bs-target="#share-btn" aria-controls="share-btn"><i class="ri-share-line"></i>
                           <span class="ms-1">Share</span></a>                           
                        </div>
                     </div>
                     <hr>
                     <ul class="post-comments list-inline p-0 m-0">
                        <li v-for="comment in post.comments">
                           <div class="d-flex mb-2">
                              <div class="user-img">
                                 <img :src="comment.user.image" alt="userimg" class="avatar-35 rounded-circle img-fluid">
                              </div>
                              <div class="comment-data-block ms-3">
                                 <h6>@{{comment.user.name}}</h6>
                                 <p class="mb-0">@{{comment.text}}</p>
                                 <div class="d-flex flex-wrap align-items-center comment-activity">
                                    <a href="javascript:void();">like</a>
                                    <a href="javascript:void();" @click="replyMode(post, comment.id, comment.user.name)">reply</a>
                                    <a href="javascript:void();">translate</a>
                                    <span> 5 min </span>
                                 </div>
                              </div>
                           </div>
                           <div class="d-flex mb-2 ms-5" v-for="reply in comment.replies">
                              <div class="user-img">
                                 <img :src="reply.user.image" alt="userimg" class="avatar-35 rounded-circle img-fluid">
                              </div>
                              <div class="comment-data-block ms-3">
                                 <h6>@{{reply.user.name}}</h6>
                                 <p class="mb-0">@{{reply.text}}</p>
                                 <div class="d-flex flex-wrap align-items-center comment-activity">
                                    <a href="javascript:void();">like</a>
                                    <a href="javascript:void();">translate</a>
                                    <span> 5 min </span>
                                 </div>
                              </div>
                           </div>
                        </li>
                     </ul>
                     <form class="comment-text d-flex align-items-center mt-3" @submit.prevent="addComment(post)">
                        <input type="text" v-model="post.commentBox" class="form-control rounded" placeholder="Enter Your Comment" :id="'enterComment_' + post.id">
                        <div class="comment-attagement d-flex">
                           <a v-if="post.replyMode" @click="cancelReply(post)" href="javascript:void();"><i class="ri-close-circle-line me-3"></i></a>
                           <a href="javascript:void();"><i class="ri-link me-3"></i></a>
                           <a href="javascript:void();"><i class="ri-user-smile-line me-3"></i></a>
                           <a href="javascript:void();"><i class="ri-camera-line me-3"></i></a>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
         </div>
      </div>
      <div class="col-lg-4">
         <div class="card">
            <div class="card-header d-flex justify-content-between">
               <div class="header-title">
                  <h4 class="card-title">Stories</h4>
               </div>
            </div>
            <div class="card-body">
               <ul class="media-story list-inline m-0 p-0">
                  <li class="d-flex mb-3 align-items-center">
                     <i class="ri-add-line"></i>
                     <div class="stories-data ms-3">
                        <h5>Creat Your Story</h5>
                        <p class="mb-0">time to story</p>
                     </div>
                  </li>
                  <li class="d-flex mb-3 align-items-center active">
                     <img src="../assets/images/page-img/s2.jpg" alt="story-img" class="rounded-circle img-fluid">
                     <div class="stories-data ms-3">
                        <h5>Anna Mull</h5>
                        <p class="mb-0">1 hour ago</p>
                     </div>
                  </li>
                  <li class="d-flex mb-3 align-items-center">
                     <img src="../assets/images/page-img/s3.jpg" alt="story-img" class="rounded-circle img-fluid">
                     <div class="stories-data ms-3">
                        <h5>Ira Membrit</h5>
                        <p class="mb-0">4 hour ago</p>
                     </div>
                  </li>
                  <li class="d-flex align-items-center">
                     <img src="../assets/images/page-img/s1.jpg" alt="story-img" class="rounded-circle img-fluid">
                     <div class="stories-data ms-3">
                        <h5>Bob Frapples</h5>
                        <p class="mb-0">9 hour ago</p>
                     </div>
                  </li>
               </ul>
               <a href="#" class="btn btn-primary d-block mt-3">See All</a>
            </div>
         </div>
         <div class="card">
            <div class="card-header d-flex justify-content-between">
               <div class="header-title">
                  <h4 class="card-title">Upcoming Birthday</h4>
               </div>
            </div>
            <div class="card-body">
               <ul class="media-story list-inline m-0 p-0">
                  <li class="d-flex mb-4 align-items-center">
                     <img src="../assets/images/user/01.jpg" alt="story-img" class="rounded-circle img-fluid">
                     <div class="stories-data ms-3">
                        <h5>Anna Sthesia</h5>
                        <p class="mb-0">Today</p>
                     </div>
                  </li>
                  <li class="d-flex align-items-center">
                     <img src="../assets/images/user/02.jpg" alt="story-img" class="rounded-circle img-fluid">
                     <div class="stories-data ms-3">
                        <h5>Paul Molive</h5>
                        <p class="mb-0">Tomorrow</p>
                     </div>
                  </li>
               </ul>
            </div>
         </div>
      </div>
      <div class="col-sm-12 text-center" v-if="loading">
         <img src="../assets/images/page-img/page-load-loader.gif" alt="loader" style="height: 100px;">
      </div>
   </div>
   @endsection
   @section('scripts')
<script>
  const app = Vue.createApp({
      data() {
          return {
            postForm: {},
            posts: [],
            loading: false,
            next_page_url: '',
            selectedImage: '',
            errorMsg: '',
            profile: JSON.parse(localStorage.getItem('profile'))
          }
      },
      created() {
        window.addEventListener('scroll', this.onScroll);
      },
      beforeDestroy() {
        window.removeEventListener('scroll', this.onScroll);
      },
      mounted(){
        this.listPosts();
      },
      methods: {
         postImageChange(){
            const file = document.getElementById("postImage").files[0];
            if(file.type == 'image/jpeg' || file.type == 'image/png')
            {
               this.selectedImage = URL.createObjectURL(file);
            }
            else
            {
               this.errorMsg = 'Invalid file type, only images allowed';
            }
         },
         onScroll() {
            if ((window.innerHeight + window.scrollY) >= document.body.scrollHeight - 100) {
               if(this.next_page_url != null) {
                  this.listPosts(this.next_page_url);
               }
            }
         },
         async createPost() {
          if(!document.getElementById('postForm').checkValidity()) return false;
          url = "api/post/create";
          let payload = new FormData();
          payload.append("text", this.postForm.text);
          let files = document.getElementById("postImage").files;
          if(files.length > 0)
          {
            payload.append("image", files[0]);
          }

          axios.post(url, payload, config).then(response => {
            this.postForm = {};
            document.getElementById("postImage").value = '';
            $("#post-modal").modal('hide');
            this.listPosts();
          });
        },
        async listPosts(url = "api/post/list") {
         if(this.loading) return;
          this.loading = true;
          const response = await fetch(url, {
            method: "GET",
            headers: {
               "Authorization": `Bearer ${token}`
            }
          });
          
          if(response.ok)
          {
            const data = await response.json();
            this.next_page_url = data.next_page_url;
            if(url == "api/post/list")
               this.posts = [];
            this.posts.push(...data.data);
          }
          this.loading = false;
        },
        async listLikes(post){
         if(this.loading) return;
          this.loading = true;
         url = "api/like/list/" + post.id;
         const response = await fetch(url, {
            method: "GET",
            headers: {
               "Authorization": `Bearer ${token}`
            }
          });
          
          if(response.ok)
          {
            const data = await response.json();
            post.likes = data;
          }
          this.loading = false;
        },
        async likePost(post){
         if(post.is_liked)
         {
            url = "api/like/remove";
         }
         else 
         {
            url = "api/like/add";
         }

          const response = await fetch(url, {
            method: "POST",
            headers: {
               "Authorization": `Bearer ${token}`,
               "Content-Type": "application/json"
            },
            body: JSON.stringify({post_id: post.id})
          });
          
          if(response.ok)
          {
            this.listLikes(post);
            post.is_liked = !post.is_liked;
          }
        },
        async addComment(post){
         if(post.replyMode)
            url = "api/comment/reply/" + post.replyingTo;
         else
            url = "api/comment/add";

          const response = await fetch(url, {
            method: "POST",
            headers: {
               "Authorization": `Bearer ${token}`,
               "Content-Type": "application/json"
            },
            body: JSON.stringify({post_id: post.id, text: post.commentBox})
          });
          
          if(response.ok)
          {
            this.cancelReply(post);
            this.listComments(post);
          }
        },
        async listComments(post)
        {
         url = "api/comment/list/" + post.id;

          const response = await fetch(url, {
            method: "GET",
            headers: {
               "Authorization": `Bearer ${token}`
            }
          });
          
          if(response.ok)
          {
            const data = await response.json();
            post.comments = data;
          }
        },
        async deletePost(post_id)
        {
            url = "api/post/delete/" + post_id;

            const response = await fetch(url, {
               method: "DELETE",
               headers: {
                  "Authorization": `Bearer ${token}`,
                  "Content-Type":"application/json"
               }
            });

            if(response.ok)
            {
               this.listPosts();
            }
        },
        removeImage()
        {
         document.getElementById('postImage').value = '';
         this.selectedImage = '';
        },
        replyMode(post, comment_id, user_name)
        {
         post.replyMode = true;
         post.replyingTo = comment_id;
         post.commentBox = '';
         document.getElementById('enterComment_' + post.id).placeholder = 'Reply to ' + user_name;
        },
        cancelReply(post)
        {
         post.replyMode = false;
         post.commentBox = '';
         document.getElementById('enterComment_' + post.id).placeholder = 'Enter your comment';
        }
      }
  });

  app.mount('#app');
</script>
@endsection