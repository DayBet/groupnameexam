<?php

namespace App\Http\Controllers;

use App\Models\Callgroups;
use App\Models\Calllists;
use Illuminate\Http\Request;

class GroupNameController extends Controller
{
    private $callgroups;
    private $calllists;

    public function __construct(Callgroups $callgroups, Calllists $calllists) {
        $this->callgroups = $callgroups;
        $this->calllists = $calllists;
    }

    /**
     * Returns the view for the welcome page
     * that contains the Group table in
     * paginated view of 10
     * 
     * @return view (paginate)
     */
    public function viewIndex()
    {
        $allGroups = $this->callgroups->paginate(10);
        return view('welcome')->with('allGroups', $allGroups);
    }

    /**
     * Returns the view for the calllists
     * that contains the Call Lists table
     * in paginated view of 10
     * 
     * @return view (paginate)
     */
    public function viewCallLists(Request $request)
    {
        $clid = $request->clid;

        $calls = $this->calllists->where('clid', $clid)->orderby('level', 'asc')->get();

        return view('CallLists')->with('calls', $calls);
    }

    public function changeLevel(Request $request)
    {
        $idToChange = $request->idToChange;

        $rowToChange = $this->calllists->find($idToChange);
        $currentLevel = $rowToChange->level;
        $clidOfToChange = $rowToChange->clid;

        switch ($request->actionBtn) {
            case 'top':
                $calls = $this->calllists->where('clid', $clidOfToChange)->where('id', 'not like', $idToChange)->get();

                $level = 2;
                foreach ($calls as $call) {
                    $call->level = $level;
                    
                    $this->calllists->find($call->id)->update(['level' => $level]);
                    
                    $level = $level+1;
                }
                
                $this->calllists->find($idToChange)->update(['level' => 1]);

                break;

            case 'up':
                $previuosRow = $this->calllists->where('clid', $clidOfToChange)->where('level', $currentLevel-1)->get();

                if (!isset($previuosRow->first()->id)) return redirect()->back();

                $previuosRowLevel = $previuosRow->first()->level;
                $previuosRow = $this->calllists->where('clid', $clidOfToChange)->where('level', $currentLevel-1)->update(['level' => $currentLevel]);

                $rowToChange = $this->calllists->find($idToChange)->update(['level' => $previuosRowLevel]);

                break;

            case 'down':
                $nextRow = $this->calllists->where('clid', $clidOfToChange)->where('level', $currentLevel+1)->get();

                if (!isset($nextRow->first()->id)) return redirect()->back();

                $nextRowLevel = $nextRow->first()->level;
                $nextRow = $this->calllists->where('clid', $clidOfToChange)->where('level', $currentLevel+1)->update(['level' => $currentLevel]);

                $rowToChange = $this->calllists->find($idToChange)->update(['level' => $nextRowLevel]);

                break;

            case 'bottom':
                $rowCount = $this->calllists->where('clid', $clidOfToChange)->get()->count();

                $this->calllists->find($idToChange)->update(['level' => $rowCount]);

                $calls = $this->calllists->where('clid', $clidOfToChange)->where('id', 'not like', $idToChange)->get();

                $level = 1;
                foreach ($calls as $call) {
                    $this->calllists->find($call->id)->update(['level' => $level]);

                    $level = $level + 1;
                }

                break;
            
            default:
                return redirect()->back();
                break;
        }
        return redirect()->back();
    }
}
