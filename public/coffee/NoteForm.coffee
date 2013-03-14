class @NoteForm
  constructor: (@selector) ->
    @form = @selector + ' form'

  observe: ->
    $(@form).on 'submit', (event) ->
      if $(this).find('input[type=text]').val() == '' or $(this).find('textarea').val() == ''
        $(this).append("<div class=\"alert alert-error\">Title and message can't be empty.</div>")
        return false

      $.ajax {
        type: "POST",
        url: $(this).attr('action'),
        data: $(this).serialize(),
        success: (data, textStatus, jqXHR) =>
          # Reset the form, append the response and call Holder to replace the images placeholders
          @reset()
          $(this).parent().append(data)
          Holder.run()

        error: (jqXHR, textStatus, errorThrown) =>
          console.log 'error_callback', jqXHR, textStatus, errorThrown
          $('#flash-messages').append("<div class=\"alert alert-error\">#{ errorThrown }</div>")
      }
      false
