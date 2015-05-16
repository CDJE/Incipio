Feature: Mandates management
  There is a mandate for every year.
  A mandate is composed of a group of users, although may not have any user.
  The job of a user is the job he has occupied for a given mandate.
  A job must belong to a mandate.
  At each new mandate, the jobs available are the job enabled.
  A job may be left empty.
  New jobs are created for the current mandate.
  A user may have one or several mandate, with or without a job.

#  Scenario: If one list all the mandates, there it at least one mandate: the current one.
#    #TODO
#
#  Scenario: A mandate may have users.
#    #TODO
#
#  Scenario: It should be possible to list all the mandates.
#    #TODO
#
#  Scenario: It should be possible to list all the members of a given mandate.
#    #TODO
#
#  Scenario: It should not be possible to create a mandate unless it starts at the current year. The ending date
#  should then be during the next year and may be omitted.
#    #TODO
#
#  Scenario: If not ending date is given for a mandate, it ends at the end of the next year.
#    #TODO
#
#  Scenario: If no new mandate has be created, a new one is automatically created and keep all the admin users as if
#  they have a new mandate.
#    #TODO
#
#  Scenario: It should not be possible to delete a mandate.
#    #TODO
#
#  Scenario: A new member can be added to a mandate even if the mandate already ended.
#    #TODO
#
#  Scenario: A member may be deleted from a mandate even if the mandate already ended.
#    #TODO
#
#  Scenario: Once a mandate created, the dates may change but must be of the same year.
#    #TODO
