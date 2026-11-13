<?php

namespace App\Helpers;

/**
 * Kho bài viết "Góc Kinh Nghiệm" (nội dung tĩnh, không cần CSDL).
 */
class BaiViet
{
    public static function all(): array
    {
        return [
            'cach-chon-gia-su-phu-hop' => [
                'tieu_de'   => 'Cách chọn gia sư phù hợp cho con: 5 tiêu chí phụ huynh cần biết',
                'tom_tat'   => 'Hồ sơ đẹp chưa chắc dạy hay. Hãy dựa vào 5 tiêu chí thực tế này để chọn đúng gia sư ngay từ lần đầu.',
                'icon'      => '🎯',
                'mau'       => ['#dbeafe', '#1d4ed8'],
                'nhom'      => 'Dành cho phụ huynh',
                'doc_phut'  => 4,
                'noi_dung'  => [
                    ['h', '1. Xác định mục tiêu trước khi tìm gia sư'],
                    ['p', 'Mất gốc, củng cố kiến thức, luyện thi vào lớp 10 hay thi đại học là những mục tiêu hoàn toàn khác nhau. Khi nêu rõ mục tiêu, bạn sẽ dễ lọc ra gia sư có đúng thế mạnh – ví dụ gia sư kinh nghiệm luyện đề cho mục tiêu thi cử, hoặc gia sư kiên nhẫn cho học sinh mất gốc.'],
                    ['h', '2. Kiểm tra trường đào tạo và chuyên ngành'],
                    ['p', 'Gia sư học đúng chuyên ngành (Sư phạm Toán dạy Toán, Sư phạm Anh dạy tiếng Anh) thường nắm chương trình và phương pháp tốt hơn. Trên Gia Sư Tri Thức, trường học, chuyên ngành và khu vực dạy đều hiển thị công khai trong hồ sơ.'],
                    ['h', '3. Đọc đánh giá của phụ huynh trước đó'],
                    ['p', 'Điểm sao trung bình và nhận xét thực tế phản ánh thái độ, sự đúng giờ và hiệu quả giảng dạy rõ hơn mọi lời giới thiệu. Ưu tiên gia sư có nhiều lượt đánh giá và số lớp đã dạy.'],
                    ['h', '4. So sánh học phí với khung chuẩn'],
                    ['p', 'Mỗi cấp học và trình độ gia sư (sinh viên, giáo viên) đều có khung học phí tham khảo. Mức giá quá thấp hay vượt khung đều là tín hiệu cần hỏi thêm. Hệ thống sẽ cảnh báo khi gia sư đặt giá vượt khung quy định.'],
                    ['h', '5. Học thử trước khi quyết định lâu dài'],
                    ['p', 'Hãy cho con học thử 1–2 buổi để quan sát cách gia sư tương tác và cách con phản hồi. Nếu chưa hợp, bạn có thể đổi gia sư mà không mất thời gian tìm lại từ đầu.'],
                ],
            ],
            'phuong-phap-hoc-hieu-qua-tai-nha' => [
                'tieu_de'   => '6 phương pháp giúp học sinh học hiệu quả hơn khi có gia sư kèm tại nhà',
                'tom_tat'   => 'Có gia sư rồi vẫn chưa tiến bộ? Vấn đề thường nằm ở cách phối hợp giữa gia sư, học sinh và phụ huynh.',
                'icon'      => '📘',
                'mau'       => ['#dcfce7', '#15803d'],
                'nhom'      => 'Phương pháp học',
                'doc_phut'  => 5,
                'noi_dung'  => [
                    ['h', 'Đặt mục tiêu nhỏ theo từng tuần'],
                    ['p', 'Thay vì mục tiêu chung chung như “giỏi Toán hơn”, hãy chia thành mục tiêu cụ thể: nắm chắc phương trình bậc hai trong tuần này, làm đúng 8/10 bài trắc nghiệm tuần sau. Mục tiêu nhỏ giúp học sinh thấy tiến bộ và giữ động lực.'],
                    ['h', 'Chuẩn bị câu hỏi trước buổi học'],
                    ['p', 'Học sinh nên ghi lại những bài chưa hiểu trong tuần để hỏi gia sư. Buổi học khi đó tập trung vào đúng chỗ yếu, tránh mất thời gian ôn lại phần đã biết.'],
                    ['h', 'Giữ lịch học cố định'],
                    ['p', 'Học vào cùng khung giờ mỗi tuần giúp hình thành thói quen. Bạn có thể chọn lịch rảnh của gia sư ngay trên hồ sơ và đăng ký giờ dạy trực tiếp.'],
                    ['h', 'Làm bài tập và nhờ gia sư chữa lỗi sai'],
                    ['p', 'Phần quan trọng nhất của buổi học là phân tích vì sao sai. Hãy yêu cầu gia sư chỉ ra lỗi tư duy, không chỉ đưa đáp án.'],
                    ['h', 'Trao đổi định kỳ với gia sư'],
                    ['p', 'Mỗi 2–4 tuần, phụ huynh nên nhắn tin hỏi gia sư về tiến độ và điểm cần cải thiện. Hệ thống chat tích hợp giúp bạn trao đổi nhanh mà không cần chia sẻ thông tin cá nhân.'],
                    ['h', 'Nghỉ ngơi đủ và học đều'],
                    ['p', 'Học dồn trước kỳ thi kém hiệu quả hơn học đều mỗi tuần. Hãy cân bằng giữa học, nghỉ và vận động để giữ sức bền.'],
                ],
            ],
            'kinh-nghiem-nhan-lop-cho-sinh-vien' => [
                'tieu_de'   => 'Sinh viên làm gia sư: kinh nghiệm nhận lớp nhanh và giữ lớp lâu dài',
                'tieu_de_ngan' => 'Kinh nghiệm nhận lớp cho sinh viên',
                'tom_tat'   => 'Hồ sơ rõ ràng, lịch rảnh minh bạch và thái độ chuyên nghiệp là chìa khóa để được phụ huynh chọn.',
                'icon'      => '👨‍🏫',
                'mau'       => ['#fef3c7', '#b45309'],
                'nhom'      => 'Dành cho gia sư',
                'doc_phut'  => 4,
                'noi_dung'  => [
                    ['h', 'Hoàn thiện hồ sơ thật kỹ'],
                    ['p', 'Ảnh đại diện lịch sự, trường học, chuyên ngành, môn dạy và kinh nghiệm cụ thể giúp phụ huynh yên tâm. Hồ sơ đầy đủ cũng được kiểm duyệt nhanh hơn.'],
                    ['h', 'Đặt học phí trong khung của trung tâm'],
                    ['p', 'Mỗi cấp học có khung học phí riêng cho sinh viên và giáo viên. Đặt giá trong khung giúp hồ sơ được hiển thị ngay, còn đặt vượt khung sẽ bị ẩn để trung tâm xem xét lại.'],
                    ['h', 'Cập nhật lịch rảnh chính xác'],
                    ['p', 'Phụ huynh thường chọn gia sư có lịch phù hợp với con mình. Lịch rảnh rõ ràng giúp bạn nhận được nhiều lời mời dạy hơn và tránh trùng lịch.'],
                    ['h', 'Phản hồi nhanh và đúng hẹn'],
                    ['p', 'Trả lời lời mời trong vòng vài giờ và đến lớp đúng giờ là yếu tố tạo thiện cảm đầu tiên. Đây cũng là tiêu chí phụ huynh hay nhắc trong phần đánh giá.'],
                    ['h', 'Theo dõi tiến bộ và báo cáo định kỳ'],
                    ['p', 'Chia sẻ ngắn gọn với phụ huynh về điểm mạnh, điểm cần cải thiện sau mỗi giai đoạn. Đó là cách giữ lớp lâu dài và nhận được đánh giá 5 sao.'],
                ],
            ],
            'on-thi-vao-lop-10-lo-trinh' => [
                'tieu_de'   => 'Lộ trình ôn thi vào lớp 10 trong 12 tuần cùng gia sư',
                'tom_tat'   => 'Chia nhỏ 12 tuần thành 3 giai đoạn: lấy lại gốc, luyện chuyên đề và luyện đề thực chiến.',
                'icon'      => '📝',
                'mau'       => ['#f3e8ff', '#7e22ce'],
                'nhom'      => 'Luyện thi',
                'doc_phut'  => 5,
                'noi_dung'  => [
                    ['h', 'Giai đoạn 1 (tuần 1–4): Lấy lại kiến thức nền tảng'],
                    ['p', 'Rà soát toàn bộ chương trình lớp 9 và những phần trọng tâm lớp 6–8 còn hổng. Gia sư làm bài kiểm tra đầu vào để xác định điểm yếu, sau đó ưu tiên sửa theo mức độ quan trọng với đề thi.'],
                    ['h', 'Giai đoạn 2 (tuần 5–8): Luyện theo chuyên đề'],
                    ['p', 'Mỗi tuần tập trung 1–2 chuyên đề lớn (ví dụ hàm số, hệ phương trình, hình học phẳng với Toán). Học sinh làm bài tập tăng dần từ cơ bản đến nâng cao và được chữa chi tiết lỗi sai.'],
                    ['h', 'Giai đoạn 3 (tuần 9–12): Luyện đề thực chiến'],
                    ['p', 'Làm đề thi thử bấm giờ, mỗi tuần 1–2 đề của các năm trước. Gia sư hướng dẫn phân bổ thời gian, kỹ thuật làm trắc nghiệm và cách trình bày bài tự luận ăn điểm.'],
                    ['h', 'Lưu ý cho phụ huynh'],
                    ['p', 'Ưu tiên giấc ngủ và sức khỏe tinh thần cho con ở giai đoạn nước rút. Trao đổi thường xuyên với gia sư để điều chỉnh lộ trình phù hợp với năng lực thực tế.'],
                ],
            ],
        ];
    }

    public static function find(string $slug): ?array
    {
        $all = self::all();
        return isset($all[$slug]) ? array_merge($all[$slug], ['slug' => $slug]) : null;
    }
}
