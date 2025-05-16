
@extends('includes/main')
@section('content')
   <div class="row" id="app">
      <div class="col-sm-12">
         <div class="card">
            <div class="card-body chat-page p-0">
               <div class="chat-data-block">
                  <div class="row">
                     <div class="col-lg-3 chat-data-left scroller">
                        <div class="chat-search pt-3 ps-3">
                           <div class="d-flex align-items-center">
                              <div class="chat-profile me-3">
                                 <img src="{{Auth::user()->image}}" alt="chat-user" class="avatar-60 ">
                              </div>
                              <div class="chat-caption">
                                 <h5 class="mb-0">{{Auth::user()->name}}</h5>
                                 <!-- <p class="m-0">Web Designer</p> -->
                              </div>
                              <button type="submit" class="close-btn-res p-3"><i class="ri-close-fill"></i></button>
                           </div>
                           <div id="user-detail-popup" class="scroller">
                              <div class="user-profile">
                                 <button type="submit" class="close-popup p-3"><i class="ri-close-fill"></i></button>
                                 <div class="user text-center mb-4">
                                    <a class="avatar m-0">
                                    <img src="../assets/images/user/1.jpg" alt="avatar">
                                    </a>
                                    <div class="user-name mt-4">
                                       <h4 class="text-center">Bni Jordan</h4>
                                    </div>
                                    <div class="user-desc">
                                       <p class="text-center">Web Designer</p>
                                    </div>
                                 </div>
                                 <hr>
                                 <div class="user-detail text-left mt-4 ps-4 pe-4">
                                    <h5 class="mt-4 mb-4">About</h5>
                                    <p>It is long established fact that a reader will be distracted bt the reddable.</p>
                                    <h5 class="mt-3 mb-3">Status</h5>
                                    <ul class="user-status p-0">
                                       <li class="mb-1"><i class="ri-checkbox-blank-circle-fill text-success pe-1"></i><span>Online</span></li>
                                       <li class="mb-1"><i class="ri-checkbox-blank-circle-fill text-warning pe-1"></i><span>Away</span></li>
                                       <li class="mb-1"><i class="ri-checkbox-blank-circle-fill text-danger pe-1"></i><span>Do Not Disturb</span></li>
                                       <li class="mb-1"><i class="ri-checkbox-blank-circle-fill text-light pe-1"></i><span>Offline</span></li>
                                    </ul>
                                 </div>
                              </div>
                           </div>
                           <div class="chat-searchbar mt-4">
                              <div class="form-group chat-search-data m-0">
                                 <input type="text" class="form-control round" id="chat-search" placeholder="Search">
                                 <i class="ri-search-line"></i>
                              </div>
                           </div>
                        </div>
                        <div class="chat-sidebar-channel scroller mt-4 ps-3">
                           <h5 class="mt-3">Direct Message</h5>
                           <ul class="iq-chat-ui nav flex-column nav-pills">
                              <li v-for="friend in friends">
                                 <a data-bs-toggle="pill" href="#chatbox6" @click="listMessages(friend)">
                                    <div class="d-flex align-items-center">
                                       <div class="avatar me-2">
                                          <img :src="friend.image" alt="chatuserimage" class="avatar-50 ">
                                          <span class="avatar-status"><i class="ri-checkbox-blank-circle-fill" :class="onlineUsers.includes(friend.id + '') ? 'text-success' : 'text-danger'"></i></span>
                                       </div>
                                       <div class="chat-sidebar-name">
                                          <h6 class="mb-0">@{{friend.name}}</h6>
                                          <!-- <span>translation by</span> -->
                                       </div>
                                    </div>
                                 </a>
                              </li>
                           </ul>
                        </div>
                     </div>
                     <div class="col-lg-9 chat-data p-0 chat-data-right">
                        <div class="tab-content">
                           <div class="tab-pane fade active show" id="default-block" role="tabpanel">
                              <div class="chat-start">
                                 <span class="iq-start-icon text-primary"><i class="ri-message-3-line"></i></span>
                                 <button id="chat-start" class="btn bg-white mt-3">Start
                                 Conversation!</button>
                              </div>
                           </div>
                           <div class="tab-pane fade" id="chatbox6" role="tabpanel">
                              <div class="chat-head">
                                 <header class="d-flex justify-content-between align-items-center bg-white pt-3 ps-3 pe-3 pb-3">
                                    <div class="d-flex align-items-center">
                                       <div class="sidebar-toggle">
                                          <i class="ri-menu-3-line"></i>
                                       </div>
                                       <div class="avatar chat-user-profile m-0 me-3">
                                          <img :src="selectedFriend.image" alt="avatar" class="avatar-50 ">
                                          <span class="avatar-status"><i class="ri-checkbox-blank-circle-fill" :class="onlineUsers.includes(selectedFriend.id + '') ? 'text-success' : 'text-danger'"></i></span>
                                       </div>
                                       <h5 class="mb-0">@{{selectedFriend.name}}</h5>
                                    </div>
                                    <div class="chat-user-detail-popup scroller">
                                       <div class="user-profile ">
                                          <button type="submit" class="close-popup p-3"><i class="ri-close-fill"></i></button>
                                          <div class="user mb-4 text-center">
                                             <a class="avatar m-0">
                                             <img src="../assets/images/user/10.jpg" alt="avatar">
                                             </a>
                                             <div class="user-name mt-4">
                                                <h4>Paul Molive</h4>
                                             </div>
                                             <div class="user-desc">
                                                <p>Cape Town, RSA</p>
                                             </div>
                                          </div>
                                          <hr>
                                          <div class="chatuser-detail text-left mt-4">
                                             <div class="row">
                                                <div class="col-6 col-md-6 title">Bni Name:</div>
                                                <div class="col-6 col-md-6 text-right">Pau</div>
                                             </div>
                                             <hr>
                                             <div class="row">
                                                <div class="col-6 col-md-6 title">Tel:</div>
                                                <div class="col-6 col-md-6 text-right">072 143 9920</div>
                                             </div>
                                             <hr>
                                             <div class="row">
                                                <div class="col-6 col-md-6 title">Date Of Birth:</div>
                                                <div class="col-6 col-md-6 text-right">July 12, 1989</div>
                                             </div>
                                             <hr>
                                             <div class="row">
                                                <div class="col-6 col-md-6 title">Gender:</div>
                                                <div class="col-6 col-md-6 text-right">Male</div>
                                             </div>
                                             <hr>
                                             <div class="row">
                                                <div class="col-6 col-md-6 title">Language:</div>
                                                <div class="col-6 col-md-6 text-right">Engliah</div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="chat-header-icons d-flex">
                                       <a href="#" class="chat-icon-phone  bg-soft-primary">
                                       <i class="ri-phone-line"></i>
                                       </a>
                                       <a href="#" class="chat-icon-video  bg-soft-primary">
                                       <i class="ri-vidicon-line"></i>
                                       </a>
                                       <a href="#" class="chat-icon-delete  bg-soft-primary">
                                       <i class="ri-delete-bin-line"></i>
                                       </a>
                                       <span class="dropdown  bg-soft-primary">
                                       <i class="ri-more-2-line cursor-pointer dropdown-toggle nav-hide-arrow cursor-pointer" id="dropdownMenuButton4" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" role="menu"></i>
                                          <span class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton4">
                                             <a class="dropdown-item" href="#"><i class="ri-pushpin-2-line me-1 h5"></i>Pin to top</a>
                                             <a class="dropdown-item" href="#"><i class="ri-delete-bin-6-line me-1 h5"></i>Delete chat</a>
                                             <a class="dropdown-item" href="#"><i class="ri-time-line me-1 h5"></i>Block</a>
                                          </span>
                                       </span>
                                    </div>
                                 </header>
                              </div>
                              <div class="chat-content scroller" id="chat-scroller">
                                 <div v-for="date in dates">
                                    <h3 align="center" class="badge bg-warning">@{{date.date}}</h3>
                                    <div class="chat" :class="message.from_id == {{Auth::user()->id}} ? 'd-flex other-user' : 'chat-left'" v-for="message in date.messages">
                                       <div class="chat-user">
                                          <div class="chat-message m-0">
                                             <p>@{{message.text}}</p>
                                          </div>
                                          <span class="chat-time mb-1" :class="message.from_id == {{Auth::user()->id}} ? 'text-end pe-2' : 'text-start ps-2'">@{{message.created_time}}</span>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <div class="chat-footer p-3 bg-white">
                                 <form class="d-flex align-items-center" @submit.prevent="sendMessage()">
                                    <div class="chat-attagement d-flex">
                                       <a href="#"><i class="far fa-smile pe-3" aria-hidden="true"></i></a>
                                       <a href="#"><i class="fa fa-paperclip pe-3" aria-hidden="true"></i></a>
                                    </div>
                                    <input type="text" class="form-control me-3" placeholder="Type your message" v-model="messageForm.text">
                                    <button type="submit" class="btn btn-primary d-flex align-items-center p-2" :disabled="!messageForm.text || messageForm.text.trim().length == ''"><i class="far fa-paper-plane" aria-hidden="true"></i><span class="d-none d-lg-block ms-1">Send</span></button>
                                 </form>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
@endsection
@section('scripts')
<script src="assets/js/socket.io.min.js"></script>
<script>

  const app = Vue.createApp({
      data() {
         return {
            friends: [],
            dates: [],
            onlineUsers: [],
            selectedFriend: {},
            messageForm: {},
            socket: null
         }
      },
      mounted() {
         this.listFriends();
         this.socket = io('ws://localhost:3000', {
            query: {
               user_id: "{{Auth::user()->id}}"
            }
         });
         this.socket.on('online-users', ({onlineUsers}) => {
            this.onlineUsers = onlineUsers;
         });
         this.socket.on('private-message', ({text, from}) => {
            if(this.selectedFriend.id == from) {
               this.messages.push({text});
               this.listMessages(this.selectedFriend);
            }
         });
      },
      methods: {
         async sendMessage()
         {
            url = "api/message/send";
            const response = await fetch(url, {
               method: "POST",
               headers: {
                  "Authorization": `Bearer ${token}`,
                  "Content-Type": "application/json"
               },
               body: JSON.stringify({text: this.messageForm.text, user_id: this.selectedFriend.id})
            });
            
            if(response.ok)
            {
               this.socket.emit("private-message", {text: this.messageForm.text, from: "{{Auth::user()->id}}", to: this.selectedFriend.id});
               this.messageForm = {};
               this.listMessages(this.selectedFriend);
            }
         },
         async listMessages(friend)
         {
            this.selectedFriend = friend;

            url = "api/message/list/" + friend.id;
            const response = await fetch(url, {
               method: "GET",
               headers: {
                  "Authorization": `Bearer ${token}`
               }
            });
            
            if(response.ok)
            {
               const data = await response.json();
               this.dates = Object.keys(data).map(date => ({
                  date,
                  messages: data[date]
               }));

               setTimeout(() => {
                  const scroller = document.getElementById('chat-scroller');
                  scroller.scrollTo({top: scroller.scrollHeight, behavior: 'smooth'});
               }, 300);
            }
         },
         async listFriends() {
            url = "api/user/listFriends";
            const response = await fetch(url, {
               method: "GET",
               headers: {
                  "Authorization": `Bearer ${token}`
               }
            });
            
            if(response.ok)
            {
               const data = await response.json();
               this.friends = data;
            }
         }
      }
   });

   app.mount("#app");
</script>
@endsection