function showPassword() {
    if( $('input[name=password]').attr('type') === 'password' ) {
        $('input[name=password]').attr('type', 'text')
        $('#eye-password').removeClass('mdi-eye')
        $('#eye-password').addClass('mdi-eye-off')
    } else {
        $('input[name=password]').attr('type', 'password')
        $('#eye-password').addClass('mdi-eye')
        $('#eye-password').removeClass('mdi-eye-off')
    }
}
function showConfirmPassword() {
    if( $('input[name=password_confirmation]').attr('type') === 'password' ) {
        $('input[name=password_confirmation]').attr('type', 'text')
        $('#eye-password-confirmation').removeClass('mdi-eye')
        $('#eye-password-confirmation').addClass('mdi-eye-off')
    } else {
        $('input[name=password_confirmation]').attr('type', 'password')
        $('#eye-password-confirmation').addClass('mdi-eye')
        $('#eye-password-confirmation').removeClass('mdi-eye-off')
    }
}
