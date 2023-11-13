 <!-- Delete Course Modal -->
 <dialog id="delete_course_modal"
     class="justify-center p-4 text-center relative z-10 modal-lg transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-2xl"
     style="width: 80%;">
     <div class="modal-box bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
         <h3 class="font-bold text-lg mb-4">Delete Course</h3>

         <h4 class="mb-4">
             Title: {{ $course->title }}
         </h4>

         <h6 class="my-6">
             Deleting a course is <span style="color: red; font-weight: 600">irreversible</span>. <br> Are you sure that you want to proceed deleting this course?
         </h6>

         <form wire:submit.prevent="deleteCourse">
             @csrf

             <div class="justify-center modal-action sm:flex sm:items-start">

                 <button type="button" onclick="delete_course_modal.close()" id="DeleteCancelButton"
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
