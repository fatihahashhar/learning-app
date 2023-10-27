 <!-- Create Course Modal -->
 <dialog id="create_course_modal"
     class="justify-center p-4 text-center relative z-10 modal-lg transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-2xl"
     style="width: 80%;">
     <div class="modal-box bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
         <h3 class="font-bold text-lg mb-4">Create New Course</h3>

         <form wire:submit.prevent="createCourse">
             @csrf

             <div data-te-input-wrapper-init>
                 <input required wire:model="title" type="text"
                     class="peer block min-h-[auto] mb-4 w-full rounded border bg-light px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-800 dark:placeholder:text-zinc-350 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-100"
                     id="inputCourseTitle" placeholder="Course Title" aria-label="Enter Course Title" />

                 <textarea required wire:model="description"
                     class="peer block min-h-[auto] mb-4 w-full rounded border bg-light px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-800 dark:placeholder:text-zinc-350 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-100"
                     id="inputDescription" placeholder="Description" aria-label="Enter Description" rows="10"></textarea>
             </div>

             <div class="justify-center modal-action sm:flex sm:items-start">

                 <button id="cancelButton"
                     class="button_secondary inline-block rounded border-2 border-primary px-2 me-2 pb-[6px] pt-2 text-xs font-medium uppercase leading-normal text-primary transition duration-150 ease-in-out hover:border-primary-600 hover:bg-red-500 hover:bg-opacity-100 hover:text-white focus:border-primary-600 focus:text-primary-600 focus:outline-none focus:ring-0 active:border-primary-700 active:text-primary-700 dark:hover:bg-red-600 dark:hover:bg-opacity-100"
                     href="#">Cancel
                 </button>

                 <button type="submit"
                     class="button_secondary inline-block rounded border-2 border-primary px-2 pb-[6px] pt-2 text-xs font-medium uppercase leading-normal text-primary transition duration-150 ease-in-out hover:border-primary-600 hover:bg-blue-500 hover:bg-opacity-100 hover:text-white focus:border-primary-600 focus:text-primary-600 focus:outline-none focus:ring-0 active:border-primary-700 active:text-primary-700 dark:hover:bg-blue-600 dark:hover:bg-opacity-100">Create
                 </button>
             </div>
         </form>
     </div>
 </dialog>


 <script>
     document.addEventListener("DOMContentLoaded", function() {
         const cancelButton = document.getElementById("cancelButton");
         const modal = document.getElementById("create_course_modal");

         cancelButton.addEventListener("click", function() {
             modal.close();
         });
     });
 </script>
