<div>
    {{-- If your happiness depends on money, you will never be happy with yourself. --}}
    <x-modal-confirm
        livewireEventToOpenModal="markAsSpamCommentWasSet"
        eventToCloseModal="commentWasMarkedAsSpam"
        modalTitle="اسپم کامنت"
        modaldescription="میخوای اسپمش کنی؟"
        modalConfirmButtonText="اره"
        wireClick="MarkCommentAsSpam"
    />
</div>
