<!-- Update Course Modal -->
<dialog id="update_course_modal"
    class="justify-center p-4 text-center relative z-10 modal-lg transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-2xl"
    style="width: 80%;">
    <div class="modal-box bg-white px-4 pb-4 pt-5 sm:p-6 sm:pb-4">
        <h3 class="font-bold text-lg mb-4">Update Course</h3>

        <form wire:submit.prevent="updateCourse">
            @csrf

            <div data-te-input-wrapper-init>
                <input wire:model.="title" type="text" value="{{ $course->title }}"
                    class="peer block min-h-[auto] mb-4 w-full rounded border bg-light px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-800 dark:placeholder:text-zinc-350 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-100"
                    id="title" aria-label="Enter Course Title" />

                <textarea wire:model="description" value="{{ $course->description }}"
                    class="peer block min-h-[auto] mb-4 w-full rounded border bg-light px-3 py-[0.32rem] leading-[1.6] outline-none transition-all duration-200 ease-linear focus:placeholder:opacity-100 peer-focus:text-primary data-[te-input-state-active]:placeholder:opacity-100 motion-reduce:transition-none dark:text-neutral-800 dark:placeholder:text-zinc-350 dark:peer-focus:text-primary [&:not([data-te-input-placeholder-active])]:placeholder:opacity-100"
                    id="description" aria-label="Enter Description" rows="10"></textarea>
            </div>

            <div class="justify-center modal-action sm:flex sm:items-start">

                <button type="button" onclick="update_course_modal.close()" id="EditCancelButton"
                    class="button_red button_red:hover px-4 me-3">Cancel
                </button>

                <button type="submit"
                    class="button_blue button_blue:hover px-4">Save Changes
                </button>
            </div>
        </form>
    </div>
</dialog>
