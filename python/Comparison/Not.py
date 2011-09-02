'''

'''

from Decision.Comparison.CompareAbstract import CompareAbstract


class Not(CompareAbstract):
	
	
	def compare(self):
		
		if not self.contextVar:
			
			return True
		
		return False
