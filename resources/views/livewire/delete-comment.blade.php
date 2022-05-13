<div>
    {{-- The Master doesn't talk, he acts. --}}
    <x-modal-confirm
        livewireEventToOpenModal="deleteCommentWasSet"
        eventToCloseModal="commentWasDeleted"
        modalTitle="حذف کامنت"
        modaldescription="مطمئنی میخوای حذفش کنی؟"
        modalConfirmButtonText="اره"
        wireClick="deleteComment"
    />

</div>
