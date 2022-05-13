<div>
    {{-- Because she competes with no one, no one can compete with her. --}}
    <x-modal-confirm
        livewireEventToOpenModal="markAsNotSpamCommentWasSet"
        eventToCloseModal="commentWasMarkedAsNotSpam"
        modalTitle="اوکی کردن اسپم"
        modaldescription="اوکیش کنم؟"
        modalConfirmButtonText="اره"
        wireClick="MarkCommentAsNotSpam"
    />
</div>
