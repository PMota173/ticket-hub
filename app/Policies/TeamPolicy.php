<?php

namespace App\Policies;

use App\Models\Team;
use App\Models\TeamInvitation;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class TeamPolicy
{
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Team $team): bool
    {
        return $team->users()->where('user_id', $user->id)->exists();
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return false;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Team $team): bool
    {
        return false;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Team $team): bool
    {
        return false;
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Team $team): bool
    {
        return false;
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Team $team): bool
    {
        return false;
    }

    public function viewAnyMembers(User $user, Team $team): bool
    {
        // checks if the user is a member of the team
        return $team->users()->where('user_id', $user->id)->exists();
    }

    public function addMember(User $user, Team $team): bool
    {
        return $team->hasAdmin($user);
    }

    public function removeMember(User $user, Team $team, User $targetMember): Response
    {
        // 1. Check if the user is an admin of the team
        if (!$team->hasAdmin($user)) {
            return Response::deny("Only team admins can remove members.");
        }

        // 2. Check if the user is trying to remove himself
        if ($user->id === $targetMember->id) {
            return Response::deny("You cannot remove yourself from the team.");
        }

        // 3. Check if the target member belongs to the team
        if (!$team->users()->where('user_id', $targetMember->id)->exists()) {
            return Response::denyAsNotFound('The specified user is not a member of the team.');
        }

        return Response::allow();
    }

    public function updateMember(User $user, Team $team, User $targetMember): Response
    {
        // 1. check if user is an admin of the team
        if (!$team->hasAdmin($user)) {
            return Response::deny("Only team admins can update member roles.");
        }

        // 2. check if user is trying to update himself
        if ($user->id === $targetMember->id) {
            return Response::deny("You cannot update your own role.");
        }

        // 3. check if target member belongs to the team
        if (!$team->users()->where('user_id', $targetMember->id)->exists()) {
            return Response::denyAsNotFound('The specified user is not a member of the team.');
        }

        return Response::allow();
    }

    public function deleteInvitation(User $user, Team $team, TeamInvitation $invitation): Response
    {
        if ($team->hasAdmin($user)) {
            return Response::allow();
        }

        if ($user->email === $invitation->email) {
            return Response::allow();
        }

        return Response::deny();
    }

    public function acceptInvitation(User $user, Team $team, User $invitedUser)
    {
        //
    }
}
