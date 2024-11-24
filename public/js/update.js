$(document).ready(function () {
  $('.edit-button').on('click', function () {
    console.log('cliccking')
    let $task = $(this).closest('.task')
    $task.find('.description').addClass('hidden')
    $task.find('.actions').addClass('hidden')

    $task.find('.editTaskForm').removeClass('hidden')
    
    $task.find('.edit-task').removeClass('hidden')
  })
})