<?php

namespace App\Policies;

use App\Employer;
use App\Job;
use Illuminate\Auth\Access\HandlesAuthorization;

class JobPolicy
{
  use HandlesAuthorization;
  public function before($employer, $ability)
  {
    if ($employer->is_admin) {
      return false;
    }
  }
  /**
   * Determine whether the user can manage the job.
   *
   * @param  \App\Job  $job
   * @return mixed
   */
  public function manage(Employer $employer)
  {
    return false;
  }

  /**
   * Determine whether the user can create jobs.
   *
   * @param  \App\User  $user
   * @return mixed
   */
  public function create(Employer $employer)
  {
    //
  }

  /**
   * Determine whether the user can update the job.
   *
   * @param  \App\User  $user
   * @param  \App\Job  $job
   * @return mixed
   */
  public function update(Employer $employer, Job $job)
  {
    //
  }

  /**
   * Determine whether the user can delete the job.
   *
   * @param  \App\User  $user
   * @param  \App\Job  $job
   * @return mixed
   */
  public function delete(Employer $employer, Job $job)
  {
    //
  }

  /**
   * Determine whether the user can restore the job.
   *
   * @param  \App\User  $user
   * @param  \App\Job  $job
   * @return mixed
   */
  public function restore(Employer $employer, Job $job)
  {
    //
  }

  /**
   * Determine whether the user can permanently delete the job.
   *
   * @param  \App\User  $user
   * @param  \App\Job  $job
   * @return mixed
   */
  public function forceDelete(Employer $employer, Job $job)
  {
    //
  }
}
