<?php
namespace App\Http\Controllers\Backend\Admin;

use App\Http\Controllers\Controller;
use App\Models\Room;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function index()
    {
        $page_data['rooms'] = Room::orderBy("created_at", "desc")->paginate(20);
        return view('backend::admin.rooms.index', $page_data);
    }

    public function store(Request $request)
    {
        $validation = $request->validate([
            'room_name' => 'required|string|max:255',
            'status'    => 'required|boolean',
        ]);

        $room = Room::create(
            [
                'school_id' => getSchoolId(),
                'room_name' => $validation['room_name'],
                'status'    => $validation['status'],
            ]
        );
        return goBack('success', 'Room created successfully');
    }

    public function update(Request $request, $id)
    {
        $room       = Room::findOrFail($id);
        $validation = $request->validate([
            'room_name' => 'required|string|max:255',
            'status'    => 'required|boolean',
        ]);

        $room->update(
            [
                'room_name' => $validation['room_name'],
                'status'    => $validation['status'],
            ]
        );
        return goBack('success', 'Room updated successfully');
    }

    public function delete($id)
    {
        $room = Room::findOrFail($id);
        $room->delete();
        return goBack('success', 'Room deleted successfully');
    }
}
