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
             Are you sure that you want to delete this course?
         </h6>

         <form wire:submit.prevent="deleteCourse">
             @csrf

             <div class="justify-center modal-action sm:flex sm:items-start">

                 <button type="button" onclick="delete_course_modal.close()" id="DeleteCancelButton"
                     class="button_secondary inline-block rounded border-2 border-primary px-3 me-2 pb-[6px] pt-2 text-xs font-medium uppercase leading-normal text-primary transition duration-150 ease-in-out hover:border-primary-600 hover:bg-blue-500 hover:bg-opacity-100 hover:text-white focus:border-primary-600 focus:text-primary-600 focus:outline-none focus:ring-0 active:border-primary-700 active:text-primary-700 dark:hover:bg-blue-600 dark:hover:bg-opacity-100"
                     href="#">No
                 </button>

                 <button type="submit"
                     class="button_secondary inline-block rounded border-2 border-primary px-3 pb-[6px] pt-2 text-xs font-medium uppercase leading-normal text-primary transition duration-150 ease-in-out hover:border-primary-600 hover:bg-red-500 hover:bg-opacity-100 hover:text-white focus:border-primary-600 focus:text-primary-600 focus:outline-none focus:ring-0 active:border-primary-700 active:text-primary-700 dark:hover:bg-red-600 dark:hover:bg-opacity-100"
                     href="#">Yes
                 </button>
             </div>
         </form>
     </div>
 </dialog>


 <script>
     document.addEventListener("DOMContentLoaded", function() {
         const cancelButton = document.getElementById("cancelButton");
         const modal = document.getElementById("delete_course_modal");

         cancelButton.addEventListener("click", function() {
             modal.close();
         });
     });
 </script>
