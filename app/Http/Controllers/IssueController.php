<?php

namespace App\Http\Controllers;

use App\Models\Issue;
use App\Models\Computer;
use Illuminate\Http\Request;

class IssueController extends Controller
{
public function index()
{
    $issues = Issue::join('computers', 'issues.computer_id', '=', 'computers.id')
        ->select(
            'issues.id',
            'issues.reported_by',
            'issues.reported_date',
            'issues.description',
            'issues.urgency',
            'issues.status',
            'computers.computer_name',
            'computers.model'
        )
        ->paginate(10); // Phân trang 10 bản ghi/trang

    return view('issues.index', compact('issues'));
}
public function create()
    {
        $computers = Computer::all();
        return view('issues.create', compact('computers'));
    }
public function store(Request $request)
{
    // Xác thực dữ liệu
    $validated = $request->validate([
        'computer_id' => 'required|exists:computers,id',
        'reported_by' => 'required|string|max:50',
        'description' => 'required|string',
        'urgency' => 'required|in:Low,Medium,High',
    ]);

    // Tạo một bản ghi mới trong bảng `issues` bằng Eloquent
    Issue::create([
        'computer_id' => $validated['computer_id'],
        'reported_by' => $validated['reported_by'],
        'description' => $validated['description'],
        'urgency' => $validated['urgency'],
        'status' => 'Open', // Mặc định trạng thái ban đầu là Open
        'reported_date' => now(), // Ngày hiện tại
    ]);

    // Redirect về danh sách với thông báo thành công
    return redirect()->route('issues.index')->with('success', 'Thêm vấn đề thành công!');
}
public function edit($id)
{
    $issue = Issue::findOrFail($id); // Tìm vấn đề theo ID
    $computers = Computer::all(); // Lấy danh sách máy tính
    return view('issues.edit', compact('issue', 'computers'));
}
public function update(Request $request, $id)
{
    $validated = $request->validate([
        'computer_id' => 'required|exists:computers,id',
        'reported_by' => 'required|string|max:50',
        'description' => 'required|string',
        'urgency' => 'required|in:Low,Medium,High',
        'status' => 'required|in:Open,In Progress,Resolved',
    ]);

    $issue = Issue::findOrFail($id);
    $issue->update($validated);

    return redirect()->route('issues.index')->with('success', 'Cập nhật vấn đề thành công!');
}
public function destroy($id)
{
    $issue = Issue::findOrFail($id);
    $issue->delete();

    return redirect()->route('issues.index')->with('success', 'Xóa vấn đề thành công!');
}
}
