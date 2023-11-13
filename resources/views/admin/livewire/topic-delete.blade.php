 <!-- Delete Topic Modal -->
 <dialog id="delete_topic_modal"
     class="justify-center p-4 text-center relative z-10 modal-lg transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-2xl"
     style="width: 80%;">
     <div class="modal-box bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
         <h3 class="font-bold text-lg mb-4">Delete Topic</h3>

         <h4 class="mb-4">
             Title: {{ $topic->title }}
         </h4>

         <h6 class="my-6">
             Deleting a topic is <span style="color: red; font-weight: 600">irreversible</span>. <br> Are you sure that you want to proceed deleting this topic?
         </h6>

         <form wire:submit.prevent="deleteTopic">
             @csrf

             <div class="justify-center modal-action sm:flex sm:items-start">

                 <button type="button" onclick="delete_topic_modal.close()" id="DeleteCancelButton"
                     class="button_blue button_blue:hover me-3 px-4"
                     href="#">No
                 </button>

                 <button type="submit"
                     class="button_red button_red:hover px-4"
                     href="#">Yes
                 </button>
             </div>
         </form>
     </div>
 </dialog>
