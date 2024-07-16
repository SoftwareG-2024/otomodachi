program xml_parser
    use, intrinsic :: iso_fortran_env, only : input_unit, output_unit
    implicit none
    character(len=128) :: line, input_file, output_file
    integer :: year, month, item, amount, income, expense, end_of_file
    character(len=128) :: item_str, amount_str
    income = 0
    expense = 0

    ! Get year and month from user
    print *, 'Enter the year (yyyy): '
    read *, year
    print *, 'Enter the month (mm): '
    read *, month

    ! Construct file names
    write(input_file, '(A,I4.4,A,I2.2,A)') '../data/', year, '_', month, '_data.xml'
    write(output_file, '(A,I4.4,A,I2.2,A)') '../data/', year, '_', month, '_stats.xml'

    ! Open input file
    open(unit=input_unit, file=input_file)

    do
        read(input_unit, '(A)', iostat=end_of_file) line
        if (end_of_file /= 0) exit
        if (index(line, '<item>') /= 0) then
            read(line, *) item_str
            read(item_str, *) item  ! Convert string to integer
        else if (index(line, '<amount>') /= 0) then
            read(line, *) amount_str
            read(amount_str, *) amount  ! Convert string to integer
            if (item == 0) then
                expense = expense + amount
            else if (item == 1) then
                income = income + amount
            end if
        end if
    end do

    print *, 'Total income: ', income
    print *, 'Total expense: ', expense

    ! Write statistics to output file
    open(unit=output_unit, file=output_file)
    write(output_unit, '(A,I0)') '<income>', income
    write(output_unit, '(A,I0)') '<expense>', expense
    close(output_unit)

    close(input_unit)
end program xml_parser
