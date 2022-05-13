

Livewire.on('profileWasUpdated',() =>
{
    Swal.fire(
        {
            title: 'پروفایل',
            text : 'پروفایل آپدیت شد',
            icon: 'success',
            confirmButtonText: 'اوکیه',
            timer: 4000
        });
})



Livewire.on('commentWasMarkedAsNotSpam',() =>
{
    Swal.fire(
        {
            title: 'test',
            text : 'NO spam',
            icon: 'success',
            confirmButtonText: 'Save',
            timer: 4000
        });
})

Livewire.on('commentWasMarkedAsSpam',() =>
{
    Swal.fire(
        {
            title: 'اسپم کامنت',
            text : 'کامنت اسپم شد',
            icon: 'success',
            confirmButtonText: 'اوکیه',
            timer: 4000
        });
})



Livewire.on('commentWasDeleted',() =>
{
    Swal.fire(
        {
            title: 'حذف کامنت',
            text : 'کامنتتون پاک کردم',
            icon: 'success',
            confirmButtonText: 'اوکیه',
            timer: 4000
        });
})

Livewire.on('commentWasUpdated',() =>
{
    Swal.fire(
        {
            title: 'ویرایش',
            text : 'کامنت ویرایش شد',
            icon: 'success',
            confirmButtonText: 'اوکیه',
            timer: 4000
        });
})


Livewire.on('commentWasAdded',() =>
{
    Swal.fire(
        {
            title: 'ایده',
            text : 'کامنت اضافه شد',
            icon: 'success',
            confirmButtonText: 'اوکیه',
            timer: 4000
        });
})

Livewire.on('ideaWasMarkedAsSpam',() =>
{
    Swal.fire(
        {
            title: 'اسپم ایده',
            text : 'ایده اسپم شد',
            icon: 'success',
            confirmButtonText: 'اوکیه',
            timer: 4000
        });
})

Livewire.on('IdeaWasUpdated',() =>
{
    Swal.fire(
        {
            title: 'ویرایش',
            text : 'ایده ویرایش شد',
            icon: 'success',
            confirmButtonText: 'اوکیه',
            timer: 4000
        });
})

Livewire.on('ideaWasMarkedAsNotSpam',() =>
{
    Swal.fire(
        {
            title: 'اوکی اپم',
            text : 'اسپم اوکی شد',
            icon: 'success',
            confirmButtonText: 'اوکیه',
            timer: 4000
        });
})

Livewire.on('ideaWasCreated',() =>
{
    Swal.fire(
        {
            title: '😄',
            text : 'ایده به اشتراک گذاشته شد',
            icon: 'success',
            confirmButtonText: 'اوکیه',
            timer: 4000
        });
})
function GoToIdea(event) {

    const tagName=event.target.tagName.toLowerCase();

    console.log(tagName);

    const ignores=['button','svg','path','span'];



    if (! ignores.includes(tagName))
    {
        event.target.closest('.idea-container').querySelector('.idea-link').click();
        // console.log(event.target.closest('.idea-container').querySelector('.idea-link'));
    }
}

function testHover()
{
    console.log('it works');
}
